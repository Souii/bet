<?php

namespace backend\models;

use yii\base\Model;
use common\models\Category;
use common\models\Match;
use common\models\MatchDetails;

class ChangeScoreForm extends Model
{
    public $match;
    public $firstTeamScore;
    public $secondTeamScore;

    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            [['firstTeamScore', 'secondTeamScore'], 'required'],
            [['firstTeamScore', 'secondTeamScore'], 'integer'],
            [['firstTeamScore', 'secondTeamScore'], 'integer', 'min' => 0],
        ];
    }

    public function change()
    {
        $this->match->changeScore($this->firstTeamScore, $this->secondTeamScore);
    }
}
