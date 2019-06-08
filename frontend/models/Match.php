<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Carbon\Carbon;

class Match extends ActiveRecord
{
  private $date;
  private static $disciplines = [
    'Football' => 1,
    'Basketball' => 2,
    'Tennis' => 3,
    'Boxing' => 4
  ];

  public static function tableName()
  {
    return '{{matches}}';
  }

  public function afterFind()
  {
    $this->date = Carbon::create($this->start_date);
  }

  public static function getDisciplines()
  {
    return self::$disciplines;
  }

  public function getDate()
  {
    return $this->date->format('d m Y');
  }

  public function getTime()
  {
    return  $this->date->format('H:i');
  }
}
