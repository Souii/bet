<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\components\validators\PhoneNumberValidator;

class Bet extends ActiveRecord
{
  const OUTCOME_WIN_1 = 1;
  const OUTCOME_WIN_2 = 2;
  const OUTCOME_DRAW = 3;
  const SCENARIO_STEP_ONE = 'step one';
  const SCENARIO_STEP_TWO = 'step two';
  const SCENARIO_AGREEMENT = 'agreement';
  const SCENARIO_DEFAULT = 'default';

  public $agree;

  public function scenarios()
  {
    return [
      self::SCENARIO_STEP_ONE => ['outcome', 'match_id'],
      self::SCENARIO_STEP_TWO => ['amount', 'phone_number'],
      self::SCENARIO_AGREEMENT => ['agree'],
      self::SCENARIO_DEFAULT => ['match_id', 'outcome', 'phone_number', 'amount'],
    ];
  }

  /**
     * {@inheritdoc}
     */
  public function rules()
  {
      return [
          [['match_id', 'amount', 'phone_number'], 'required'],

          ['outcome', 'required', 'message' => 'Выберите исход, на который вы хотите сделать ставку'],

          ['agree', 'required', 'message' => 'Вы должны принять пользовательское соглашение'],
          ['agree', 'compare', 'compareValue' => true],

          ['phone_number', 'trim'],
          ['phone_number', 'number'],
          ['phone_number', 'string', 'length' => [11, 12]],
          ['phone_number', PhoneNumberValidator::className()],

          ['amount', 'integer'],
          ['match_id', 'exist', 'targetClass' => Match::class, 'targetAttribute' => ['match_id' => 'id']],
          ['outcome', 'in', 'range' => [Bet::OUTCOME_WIN_1, Bet::OUTCOME_WIN_2, Bet::OUTCOME_DRAW]],
      ];
  }

  public function attributeLabels()
  {
    return [
      'outcome' => 'Исход',
      'amount' => 'Сумма',
      'phone_number' => 'Номер телефона'
    ];
  }

  public function calculateWinnings($coefficient)
  {
    return intval($this->amount * $coefficient);
  }
}
