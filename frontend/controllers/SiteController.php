<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Match;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
     public function actionIndex()
     {
         $matches = Match::find()->all();

         return $this->render('index', [
           'matches' => $matches,
           'disciplines' => Match::getDisciplines()
         ]);
     }

     public function actionDiscipline($id)
     {
       $matches = Match::findAll([
         'discipline' => $id
       ]);

       return $this->render('index', [
         'matches' => $matches,
       ]);
     }
}
