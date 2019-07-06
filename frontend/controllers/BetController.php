<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use frontend\models\Bet;
use frontend\models\Match;
use frontend\models\Phone;
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

    public function actionFirstStep($id)
    {
        $this->sessionStorage->clear();
        $model = new Bet(['scenario' => Bet::SCENARIO_FIRST_STEP]);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {
            $this->sessionStorage->save($post['Bet']);
            $this->sessionStorage->save(['match_id' => $id]);
            return $this->redirect('/bet/second-step');
        }

        return $this->render('first-step', [
            'match' => $this->findMatch($id),
            'model' => $model
        ]);
    }

    public function actionSecondStep()
    {
        if ($this->sessionStorage->isEmpty()) {
            $this->goBack(Yii::$app->homeUrl);
        }
        $model = new Bet(['scenario' => Bet::SCENARIO_SECOND_STEP]);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate()) {
            try {
                $model->scenario = Bet::SCENARIO_DEFAULT;
                $phone = Phone::findByNumber($model->phone_number);
                $phone->writeOffs($model->amount);

                if ($model->load($this->sessionStorage->getAll()) && $model->save() && $phone->update()) {
                    $this->sessionStorage->clear();
                    return $this->redirect('/bet/success');
                } else {
                    return $this->redirect('/bet/error');
                }
            } catch (\DomainException $e) {
                $model->addError('phone_number', $e->getMessage());
            }
        }
        return $this->render('second-step', [
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

    private function findMatch($id)
    {
        if (!is_null($match = Match::findOne($id))) {
            return $match;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
