<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Match;
use yii\web\Controller;
use DateTime;
use DateInterval;
use Carbon\Carbon;


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
     
     private function getUpcomingMatches($discipline=null)
     {
       $current = Carbon::now();
       $upcoming = (Carbon::now())->add('30 days');
       $matches = Match::find()->where(['between', 'start_date', $current->format('Y-m-d H:i'), $upcoming->format('Y-m-d H:i') ]);
       
       if ($discipline !== null)
       {
         $matches = $matches->andWhere(['discipline' => $discipline])->orderBy('start_date')->all();
       }
       else $matches = $matches->orderBy('start_date ASC')->all();
       
       return $matches;
     }
}
