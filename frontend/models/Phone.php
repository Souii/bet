<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%phones}}".
 *
 * @property int $id
 * @property string $phone
 * @property string $operator
 * @property int $balance
 * @property string $status
 */
class Phone extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return '{{%phones}}';
    }

    public static function findByNumber($phone_number)
    {
        $phone = self::find()->where(['phone' => $phone_number])->one();

        if ($phone === null) {
            throw new \DomainException('Некорректный номер телефона');
        } elseif (!$phone->isActive()) {
            throw new \DomainException('Номер заблокирован');
        }
        return $phone;
    }

  	public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function writeOffs($amount)
    {
        if ($this->balance > $amount) {
            $this->balance = $this->balance - $amount;
        } else {
            throw new \DomainException('На балансе недостаточно средств');
        }
    }
}
