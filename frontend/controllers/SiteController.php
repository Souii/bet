<?php
namespace frontend\controllers;

use Yii;
use common\models\Match;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Category;


/**
 * Site controller
 */
class SiteController extends Controller
{

    public function actions()
     {
         return [
             'error' => [
                 'class' => 'yii\web\ErrorAction',
             ],
         ];
     }

    public function actionIndex()
    {
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    public function actionTerms()
    {
        return $this->render('terms');
    }

    public function actionMatches($category)
    {
        $matches = Match::find()->upcoming($category)->orderBy('start_date ASC')->all();

        return $this->render('matches', [
          'matches' => $matches
        ]);
    }
}
