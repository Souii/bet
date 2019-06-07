<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Match;
use yii\web\Controller;
use DateTime;
use DateInterval;


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
         $matches = $this->getUpcomingMatches();

         return $this->render('index', [
           'matches' => $matches,
           'disciplines' => Match::getDisciplines()
         ]);
     }

     public function actionDiscipline($id)
     {
       $matches = $this->getUpcomingMatches($id);

       return $this->render('index', [
         'matches' => $matches,
       ]);
     }
     
     private function getUpcomingMatches($id=null)
     {
       $currenDate = new DateTime();
       $upcoming = (new DateTime())->add(new DateInterval('P30D'));
       $matches = Match::find()->where(['between', 'start_date', $currenDate->format('Y-m-d'), $upcoming->format('Y-m-d') ]);
       
       if ($id !== null)
       {
         $matches = $matches->andWhere(['discipline' => $id])->all();
       }
       else $matches = $matches->all();
       
       return $matches;
     }
}
