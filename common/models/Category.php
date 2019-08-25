<?php

namespace common\models;

use yii\db\ActiveRecord;

class Category extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            ['name', 'required']
        ];
    }
}
