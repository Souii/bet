<?php

namespace backend\models;

use yii\base\Model;
use common\models\Category;
use common\models\Match;
use common\models\MatchDetails;

class ChangeCoefForm extends Model
{
    public $match;
    public $firstTeamCoef;
    public $secondTeamCoef;
    public $drawCoef;

    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            [['firstTeamCoef', 'secondTeamCoef', 'drawCoef'], 'required'],
            [['firstTeamCoef', 'secondTeamCoef', 'drawCoef'], 'double', 'min' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstTeamCoef' => 'Коэффициент ' . $this->match->details->first_team,
            'secondTeamCoef' => 'Коэффициент ' . $this->match->details->second_team,
            'drawCoef' => 'Коэффициент ' . Match::OUTCOME_DRAW
        ];
    }

    public function change()
    {
        $this->match->changeCoef($this->firstTeamCoef, $this->secondTeamCoef, $this->drawCoef);
        $this->match->update();
    }
}
