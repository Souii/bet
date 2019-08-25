<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Match extends ActiveRecord
{
    const OUTCOME_DRAW = 'Draw';

    const STATUS_UPCOMING = 'Upcoming';
    const STATUS_CURRENT = 'Current';
    const STATUS_CANCELED = 'Canceled';
    const STATUS_FINISHED = 'Finished';

    public static function tableName()
    {
        return '{{%matches}}';
    }

    public static function find()
    {
      return new MatchQuery(get_called_class());
    }

    public static function create($category, $matchDetails, $firstTeamCoef, $secondTeamCoef, $drawCoef, $startDate)
    {
        $match = new self();
        $match->category_id = $category;
        $match->match_details_id = $matchDetails;
        $match->first_team_coef = $firstTeamCoef;
        $match->second_team_coef = $secondTeamCoef;
        $match->draw_coef = $drawCoef;
        $match->start_date = $startDate;
        $match->status = self::STATUS_UPCOMING;
        return $match;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getDetails()
    {
        return $this->hasOne(MatchDetails::className(), ['id' => 'match_details_id']);
    }

    public function isLiveValue()
    {
        if ($this->isLive()) {
            return 'Yes';
        }
        return 'No';
    }

    public function isLive()
    {
        return $this->is_live;
    }

    public function isCurrent()
    {
        return $this->status === self::STATUS_CURRENT;
    }

    public function isUpcoming()
    {
        return $this->status === self::STATUS_UPCOMING;
    }

    public function isActive()
    {
        return $this->isCurrent() || $this->isUpcoming();
    }

    public function canBet()
    {
        return $this->isUpcoming() || $this->isLive();
    }

    public function isEventDate()
    {
        $today = new \DateTime();
        $today->setTime( 0, 0, 0 );
        $eventDate = \DateTime::createFromFormat('Y-m-d H:i:s', $this->start_date);
        $eventDate->setTime( 0, 0, 0 );
        return $today == $eventDate;
    }

    public function setLive()
    {
        if ($this->is_live) {
            $this->is_live = false;
        } else {
            $this->is_live = true;
        }
    }

    public function canStart()
    {
        return $this->isUpcoming() && $this->isEventDate();
    }

    public function start()
    {
        $this->status = self::STATUS_CURRENT;
    }

    public function canFinish()
    {
        return $this->isCurrent();
    }

    public function finish($firstTeamScore, $secondTeamScore, $outcome)
    {
        $this->details->first_team_score = $firstTeamScore;
        $this->details->second_team_score = $secondTeamScore;
        $this->details->outcome = $outcome;
        $this->details->update();
        $this->is_live = false;
        $this->status = self::STATUS_FINISHED;
    }

    public function changeScore($firstTeamScore, $secondTeamScore)
    {
        $this->details->first_team_score = intval($firstTeamScore);
        $this->details->second_team_score = intval($secondTeamScore);
        $this->details->update();
    }

    public function changeCoef($firstTeamCoef, $secondTeamCoef, $drawCoef)
    {
        $this->first_team_coef = $firstTeamCoef;
        $this->second_team_coef = $secondTeamCoef;
        $this->draw_coef = $drawCoef;
    }

    public function canCancel()
    {
        return $this->isActive();
    }

    public function cancel()
    {
        $this->is_live = false;
        $this->status = self::STATUS_CANCELED;
    }

    public function canMove()
    {
        return $this->isUpcoming();
    }

    public function move($date)
    {
        $this->start_date = $date;
    }

    public function getDate()
    {
      return date('d.m.Y', strtotime($this->start_date));
    }

    public function getTime()
    {
      return date('H:i', strtotime($this->start_date));
    }

    public function getOutcomes()
    {
        return [
            $this->details->first_team => $this->details->first_team,
            $this->details->second_team => $this->details->second_team,
            self::OUTCOME_DRAW => self::OUTCOME_DRAW,
        ];
    }

    public function getCoef($outcome)
    {
        switch ($outcome) {
          case $this->details->first_team:
            return $this->first_team_coef;

          case $this->details->second_team:
            return $this->second_team_coef;

          case self::OUTCOME_DRAW:
            return $this->draw_coef;
        }
    }
}
