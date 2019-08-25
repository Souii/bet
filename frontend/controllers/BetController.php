<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\models\Bet;
use frontend\models\FirstStepForm;
use frontend\models\SecondStepForm;
use common\models\Match;
use frontend\models\Phone;
use frontend\components\SimpleSessionStorage;
use yii\base\DynamicModel;

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
        $match = $this->findMatch($id);
        if (!$match->canBet()) {
            return $this->goBack();
        }
        $model = new FirstStepForm($match);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->sessionStorage->save(['match_id' => $id]);
            $this->sessionStorage->save(['outcome' => $model->outcome]);
            $this->sessionStorage->save(['coef' => $model->getCoef()]);
            return $this->redirect('/bet/second-step');
        }

        return $this->render('first-step', [
            'match' => $match,
            'model' => $model
        ]);
    }

    public function actionSecondStep()
    {
        if ($this->sessionStorage->isEmpty()) {
            return $this->goHome();
        }
        $model = new SecondStepForm($this->sessionStorage->get('match_id'));

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->sessionStorage->save(['phone_number' => $model->phoneNumber]);
            $this->sessionStorage->save(['amount' => $model->amount]);
            return $this->redirect('/bet/third-step');
        }
        return $this->render('second-step', [
          'model' => $model,
        ]);
    }

    public function actionThirdStep()
    {
        if ($this->sessionStorage->isEmpty()) {
            return $this->goHome();
        }
        $model = new DynamicModel(['agree']);
        $model->addRule('agree', 'required', ['message' => 'Вы должны принять пользовательское соглашение'])
              ->addRule('agree', 'compare', ['compareValue' => true]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $bet = new Bet();
            $bet->load($this->sessionStorage->getAll());
            $bet->status = Bet::STATUS_ACTIVE;
            try {
                $phone = Phone::findByNumber($bet->phone_number);
                $phone->writeOffs($bet->amount);
            } catch(\DomainException $e) {
                return $this->redirect('/bet/error');
            }
            $bet->save();
            $phone->update();
            $this->sessionStorage->clear();
            return $this->redirect('/bet/success');
        }
        return $this->render('third-step', [
            'model' => $model,
            'match' => $this->findMatch($this->sessionStorage->get('match_id')),
            'outcome' => $this->sessionStorage->get('outcome'),
            'amount' => $this->sessionStorage->get('amount'),
            'coef' => $this->sessionStorage->get('coef')
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
