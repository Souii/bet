<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use frontend\components\validators\PhoneNumberValidator;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property int $id
 * @property int $match_id
 * @property string $phone_number
 * @property int $amount
 * @property int $outcome
 */
class Bet extends ActiveRecord
{
    const OUTCOME_WIN_1 = 1;
    const OUTCOME_WIN_2 = 2;
    const OUTCOME_DRAW = 3;
    const SCENARIO_FIRST_STEP = 'step one';
    const SCENARIO_SECOND_STEP = 'step two';
    const SCENARIO_DEFAULT = 'default';

    public $agree;

    public function scenarios()
    {
        return [
            self::SCENARIO_FIRST_STEP => ['outcome', 'match_id'],
            self::SCENARIO_SECOND_STEP => ['amount', 'phone_number', 'agree'],
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

            ['match_id', 'exist', 'targetClass' => Match::class, 'targetAttribute' => ['match_id' => 'id']],
            ['outcome', 'required', 'message' => 'Выберите исход, на который вы хотите сделать ставку'],
            ['outcome', 'in', 'range' => [Bet::OUTCOME_WIN_1, Bet::OUTCOME_WIN_2, Bet::OUTCOME_DRAW]],

            ['phone_number', 'trim'],
            ['phone_number', 'number'],
            ['phone_number', 'string', 'length' => 10],
            ['phone_number', PhoneNumberValidator::className()],
            ['amount', 'number', 'min' => 100, 'max' => 1000, 'integerOnly' => true],
            ['agree', 'required', 'message' => 'Вы должны принять пользовательское соглашение'],
            ['agree', 'compare', 'compareValue' => true],
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
}
