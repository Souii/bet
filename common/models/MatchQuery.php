<?php

namespace common\models;

use yii\db\ActiveQuery;

class MatchQuery extends ActiveQuery
{
    public function upcoming($category)
    {
        $now = new \DateTime();
        $upcoming = (new \DateTime())->add(new \DateInterval('P30D'));
        $this->andWhere(['between', 'start_date', $now->format('Y-m-d H:i'),$upcoming->format('Y-m-d H:i')])
             ->andWhere(['category_id' => $category])
             ->andWhere(['status' => [Match::STATUS_UPCOMING, Match::STATUS_CURRENT]]);
        return $this;
    }
}
