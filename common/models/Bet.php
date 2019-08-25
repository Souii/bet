<?php

namespace common\models;

use yii\db\ActiveRecord;
use frontend\components\validators\PhoneNumberValidator;
use common\models\Match;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property int $id
 * @property int $match_id
 * @property string $phone_number
 * @property int $amount
 * @property int $outcome
 */
class Bet extends ActiveRecord
{
    const STATUS_ACTIVE = 'Active';
    const STATUS_PAYED = 'Payed';
    const STATUS_CANCELED = 'Canceled';

    /**
       * {@inheritdoc}
       */
    public function rules()
    {
        return [
            [['match_id', 'amount', 'phone_number', 'outcome', 'coef'], 'safe']
        ];
    }

    public function getMatch()
    {
        return $this->hasOne(Match::className(), ['id' => 'match_id']);
    }
}
