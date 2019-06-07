<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class Match extends ActiveRecord
{  
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

  public static function getDisciplines()
  {
    return self::$disciplines;
  }
}
