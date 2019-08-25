<?php

namespace backend\models;

use yii\base\Model;
use common\models\Category;
use common\models\Match;
use common\models\MatchDetails;

class MoveMatchForm extends Model
{
    public $match;
    public $eventDate;
    public $eventTime;
    public $startDate;

    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            [['eventDate', 'eventTime'], 'required'],
            [['eventDate', 'eventTime'], 'trim'],
            ['eventDate', 'date', 'format' => 'yyyy-mm-dd'],
            ['eventTime', 'date', 'format' => 'H:i'],
            [['eventDate', 'eventTime'], 'validateEventDateTime']
        ];
    }

    public function validateEventDateTime($attribute, $params)
    {
        $today = new \DateTime();
        $this->startDate = \DateTime::createFromFormat( "Y-m-d H:i", "$this->eventDate $this->eventTime" );
        if ($this->startDate < $today) {
            $this->addError($attribute, 'Invalid datetime value');
        }
    }

    public function move()
    {
        $this->match->move($this->startDate->format('Y-m-d H:i'));
        $this->match->save();
    }
}
