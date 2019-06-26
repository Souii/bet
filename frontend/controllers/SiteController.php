<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Match;
use yii\web\Controller;
use Carbon\Carbon;
use yii\web\NotFoundHttpException;


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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
     public function actionIndex()
     {
         $matches = Match::find()->upcoming()->orderBy('start_date ASC')->all();

         return $this->render('index', [
           'matches' => $matches,
           'disciplines' => Match::getDisciplines()
         ]);
     }

     public function actionDiscipline($id)
     {
       if(!Match::isCorrectDiscipline($id))
        throw new NotFoundHttpException("Страница не найдена.");
        
       $matches = Match::find()->upcoming($id)->orderBy('start_date ASC')->all();

       return $this->render('index', [
         'matches' => $matches,
       ]);
     }
}
