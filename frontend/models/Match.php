<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\models\MatchQuery;

class Match extends ActiveRecord
{
  private static $disciplines = [
    'Футбол' => 1,
    'Баскетбол' => 2,
    'Теннис' => 3,
    'Бокс' => 4
  ];

  public static function find()
  {
    return new MatchQuery(get_called_class());
  }

  public static function isCorrectDiscipline($discipline)
  {
    foreach (self::$disciplines as $key => $value) {
      if (intval($discipline) == $value)
        return true;
    }
      return false;
  }

  public static function tableName()
  {
    return '{{matches}}';
  }

  public static function getDisciplines()
  {
    return self::$disciplines;
  }

  public function getDate()
  {
    return date('d.m.Y', strtotime($this->start_date));
  }

  public function getTime()
  {
    return date('H:i',strtotime($this->start_date));
  }
}
