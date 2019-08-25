<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class MatchDetails extends ActiveRecord
{
    public static function create($firstTeam, $secondTeam)
    {
        $matchDetails = new self();
        $matchDetails->first_team = $firstTeam;
        $matchDetails->second_team = $secondTeam;
        return $matchDetails;
    }
}
