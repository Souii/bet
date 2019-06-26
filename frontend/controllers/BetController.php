<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use frontend\models\Bet;
use frontend\models\Match;
use frontend\helpers\UrlComparer;
use frontend\components\SimpleSessionStorage;

class BetController extends Controller
{
  private $sessionStorage;

  public function beforeAction($action)
  {
      $this->sessionStorage = new SimpleSessionStorage('Bet');

      if (!parent::beforeAction($action)) {
          return false;
      }

      return true;
  }

  public function actionStepOne($id)
  {
    if (is_null($match = Match::findOne($id)))
      throw new NotFoundHttpException('The requested page does not exist.');

    $model = new Bet(['scenario' => Bet::SCENARIO_STEP_ONE]);
    $post = Yii::$app->request->post();

    if ($model->load($post) && $model->validate())
    {
      $this->sessionStorage->clear();
      $this->sessionStorage->save($post['Bet']);
      return $this->redirect('/bet/step-two');
    }

    return $this->render('step-one', [
      'match' => $match,
      'model' => $model
    ]);
  }

  public function actionStepTwo()
  {
    $this->redirectIfAdressMismatch(Url::to('bet/step-one', true));

    $model = new Bet(['scenario' => Bet::SCENARIO_STEP_TWO]);
    $post = Yii::$app->request->post();

    if ($model->load($post) && $model->validate())
    {
      $this->sessionStorage->save($post['Bet']);
      return $this->redirect('/bet/step-three');
    }

    return $this->render('step-two', [
      'model' => $model,
    ]);
  }

  public function actionStepThree()
  {
    $this->redirectIfAdressMismatch(Url::to('bet/step-two', true));

    $model = new Bet(['scenario' => Bet::SCENARIO_AGREEMENT]);

    if ($model->load(Yii::$app->request->post()) && $model->validate())
    {
      $model->scenario = Bet::SCENARIO_DEFAULT;
      if ($model->load($this->sessionStorage->getData()) && $model->save())
      {
        $this->sessionStorage->clear();
        return $this->redirect('/bet/success');
      }
      else
        return $this->redirect('/bet/error');
    }

    return $this->render('/bet/step-three', [
      'model' => $model,
    ]);

  }

  public function actionSuccess()
  {
    return $this->render('success');
  }

  public function actionError()
  {
    return $this->render('error');
  }

  private function redirectIfAdressMismatch($previousUrl)
  {
    $url = Yii::$app->request->referrer;

    if (Yii::$app->request->isGet && !UrlComparer::compare($previousUrl, $url))
        $this->goBack(Yii::$app->getHomeUrl());
  }
}
