<?php

namespace frontend\models;

use yii\base\Model;
use common\models\Match;
use common\models\MatchDetails;
use common\models\Bet;

class FirstStepForm extends Model
{
    public $match;
    public $outcome;

    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            ['outcome', 'required'],
            ['outcome', 'validateOutcome'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'outcome' => 'Исход'
        ];
    }

    public function validateOutcome($attribute, $params)
    {
        if ($this->getCoef() === false) {
            $this->addError($attribute, 'Incorrect outcome');
        }
    }

    public function getCoef()
    {
        return $this->match->getCoef($this->outcome);
    }
}
