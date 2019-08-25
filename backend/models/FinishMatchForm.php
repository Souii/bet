<?php

namespace backend\models;

use yii\base\Model;
use common\models\Category;
use common\models\Match;
use common\models\MatchDetails;
use common\models\Bet;

class FinishMatchForm extends Model
{
    public $match;
    public $firstTeamScore;
    public $secondTeamScore;
    public $outcome;

    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    public function rules()
    {
        return [
            [['firstTeamScore', 'secondTeamScore', 'outcome'], 'required'],
            [['firstTeamScore', 'secondTeamScore', 'outcome'], 'trim'],
            [['firstTeamScore', 'secondTeamScore'], 'integer', 'min' => 0],
            ['outcome', 'validateOutcome'],
        ];
    }

    public function validateOutcome($attribute, $params)
    {
        if (!in_array($this->outcome, [$this->match->details->first_team,
                      $this->match->details->second_team, Bet::OUTCOME_DRAW])) {
            $this->addError($attribute, 'Incorrect outcome');
        }
    }

    public function finish()
    {
        $this->match->finish($this->firstTeamScore, $this->secondTeamScore, $this->outcome);
        $this->match->save();
    }
}
