<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Match;
use backend\models\AddMatchForm;
use backend\models\MoveMatchForm;
use backend\models\ChangeScoreForm;
use backend\models\ChangeCoefForm;
use backend\models\FinishMatchForm;
use common\models\Category;

/**
 * Site controller
 */
class MatchController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             'actions' => ['login', 'error'],
            //             'allow' => true,
            //         ],
            //         [
            //             'actions' => ['logout', 'index', 'add', 'start', 'move', 'finish', 'cancel', 'set-live'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $matches = Match::find()->all();

        return $this->render('index', [
            'matches' => $matches
        ]);
    }

    public function actionAdd()
    {
        $match = new AddMatchForm();
        if ($match->load(Yii::$app->request->post()) && $match->validate()) {
            $match->add();
            $this->redirect('/match');
        }
        return $this->render('add', [
            'match' => $match,
            'categories' => Category::find()->all()
        ]);
    }

    public function actionStart($id)
    {
        $match = $this->findMatch($id);
        if (!$match->canStart()) {
            Yii::$app->session->setFlash('error', 'Невозможно начать матч');
            return $this->redirect('/match');
        }
        $match->start();
        $match->save();
        return $this->redirect('/match');
    }

    public function actionSetLive($id)
    {
        $match = $this->findMatch($id);
        if (!$match->isCurrent()) {
            Yii::$app->session->setFlash('error', 'Невозможно переключить на Live');
            return $this->redirect('/match');
        }
        $match->setLive();
        $match->save();
        return $this->redirect('/match');
    }

    public function actionChangeScore($id)
    {
        $match = $this->findMatch($id);
        if (!$match->isLive()) {
            Yii::$app->session->setFlash('error', 'Невозможно поменять счет матча');
            return $this->redirect('/match');
        }
        $model = new ChangeScoreForm($match);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->change();
            return $this->redirect('/match');
        }
        return $this->render('change-score', [
            'model' => $model
        ]);
    }

    public function actionChangeCoef($id)
    {
        $match = $this->findMatch($id);
        if (!$match->isLive()) {
            Yii::$app->session->setFlash('error', 'Невозможно изменить коэффициенты матча');
            return $this->redirect('/match');
        }
        $model = new ChangeCoefForm($match);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->change();
            return $this->redirect('/match');
        }
        return $this->render('change-coef', [
            'model' => $model
        ]);
    }

    public function actionMove($id)
    {
        $match = $this->findMatch($id);
        if (!$match->canMove()) {
            Yii::$app->session->setFlash('error', 'Невозможно перенести матч');
            return $this->redirect('/match');
        }
        $model = new MoveMatchForm($match);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->move();
            return $this->redirect('/match');
        }
        return $this->render('move', [
            'model' => $model
        ]);
    }

    public function actionFinish($id)
    {
        $match = $this->findMatch($id);
        if (!$match->canFinish()) {
            Yii::$app->session->setFlash('error', 'Невозможно закончить матч');
            return $this->redirect('/match');
        }
        $model = new FinishMatchForm($match);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->finish();
            return $this->redirect('/match');
        }
        return $this->render('finish', [
            'model' => $model,
            'match' => $match
        ]);
    }

    public function actionCancel($id)
    {
        $match = $this->findMatch($id);
        if (!$match->canCancel()) {
            Yii::$app->session->setFlash('error', 'Невозможно отменить матч');
            return $this->redirect('/match');
        }
        $match->cancel();
        $match->save();
        return $this->redirect('/match');
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
