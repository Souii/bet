<?php

namespace frontend\models;

use yii\base\Model;
use common\models\Match;
use common\models\MatchDetails;
use common\models\Bet;

class SecondStepForm extends Model
{
    public $match;
    public $phone;
    public $phoneNumber;
    public $amount;

    public function __construct($match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            [['phoneNumber', 'amount'], 'required'],
            [['phoneNumber', 'amount'], 'trim'],
            ['phoneNumber', 'number'],
            ['phoneNumber', 'string', 'length' => 10],
            ['phoneNumber', 'validatePhoneNumber'],
            ['phoneNumber', 'uniqueBet', 'skipOnError' => true],
            ['phoneNumber', 'enoughMoney', 'skipOnError' => true],
            ['amount', 'number', 'min' => 1000, 'max' => 10000, 'integerOnly' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Сумма',
            'phoneNumber' => 'Номер телефона'
        ];
    }

    public function validatePhoneNumber($attribute, $params)
    {
        try {
            $this->phone = $this->getPhone();
        } catch (\DomainException $e) {
            $this->addError($attribute, $e->getMessage());
        }
    }

    public function enoughMoney($attribute, $params)
    {
        if ($this->phone->balance < $this->amount) {
            $this->addError($attribute, 'На балансе недостаточно средств');
        }
    }

    public function uniqueBet($attribute, $params)
    {
        $bet = Bet::find()->where(['match_id' => $this->match])
                          ->andWhere(['phone_number' => $this->phoneNumber])
                          ->andWhere(['status' => Bet::STATUS_ACTIVE])->one();
        if (!empty($bet)) {
            $this->addError($attribute, 'По этому номеру уже есть ставка на этот матч');
        }
    }

    public function getPhone()
    {
        return Phone::findByNumber($this->phoneNumber);
    }
}
