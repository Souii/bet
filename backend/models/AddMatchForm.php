<?php

namespace backend\models;

use yii\base\Model;
use common\models\Category;
use common\models\Match;
use common\models\MatchDetails;

class AddMatchForm extends Model
{
    public $category;
    public $firstTeam;
    public $firstTeamCoef;
    public $secondTeam;
    public $secondTeamCoef;
    public $drawCoef;
    public $eventDate;
    public $eventTime;
    public $startDate;

    public function rules()
    {
        return [
            [['category', 'firstTeam', 'secondTeam', 'eventDate', 'eventTime', 'firstTeamCoef', 'secondTeamCoef', 'drawCoef'], 'required'],
            [['firstTeam', 'secondTeam', 'eventDate', 'eventTime', 'firstTeamCoef', 'secondTeamCoef', 'drawCoef'], 'trim'],
            ['category', 'exist', 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            [['firstTeam', 'secondTeam'], 'string'],
            [['firstTeamCoef', 'secondTeamCoef', 'drawCoef'], 'double', 'min' => 1],
            ['eventDate', 'date', 'format' => 'yyyy-mm-dd'],
            ['eventTime', 'date', 'format' => 'H:i'],
            [['eventDate', 'eventTime'], 'validateEventDateTime']
        ];
    }

    public function attributeLabels()
    {
        return [
            'category' => 'Вид спорта',
            'firstTeam' => 'Первая команда',
            'firstTeamCoef' => 'Коэффициент на первую команду',
            'secondTeam' => 'Вторая команда',
            'secondTeamCoef' => 'Коэффициент на вторую команду',
            'drawCoef' => 'Коэффициент на ничью',
            'eventDate' => 'Дата начала',
            'eventTime' => 'Время начала',
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

    public function add()
    {
        $matchDetails = MatchDetails::create($this->firstTeam, $this->secondTeam);
        $matchDetails->save();
        $match = Match::create($this->category, $matchDetails->getPrimaryKey(), $this->firstTeamCoef,
                              $this->secondTeamCoef, $this->drawCoef, $this->startDate->format('Y-m-d H:i'));
        $match->save();
    }
}
