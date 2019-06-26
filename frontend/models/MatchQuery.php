<?php

namespace frontend\models;

use yii\db\ActiveQuery;
use Carbon\Carbon;

class MatchQuery extends ActiveQuery
{
    public function upcoming($discipline=null)
    {
      $now = Carbon::now();
      $upcoming = (Carbon::now())->add('30 days');
      $this->andWhere(['between', 'start_date', $now->format('Y-m-d H:i'), $upcoming->format('Y-m-d H:i') ]);

      if ($discipline !== null)
      {
        $this->andWhere(['discipline' => $discipline]);
      }
      return $this;
    }
}
