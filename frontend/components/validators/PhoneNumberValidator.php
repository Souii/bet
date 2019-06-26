<?php

namespace frontend\components\validators;

use yii\validators\Validator;

class PhoneNumberValidator extends Validator
{
    private $codes = ['701', '775', '778', '705', '777'];
    private $operators = ['Актив', 'Билайн'];

    public function validateAttribute($model, $attribute)
    {
        $number = $model[$attribute];
        $number = $this->getCode($number);

        if ($number !== false)
        {
          foreach ($this->codes as $code) {
              if (strcasecmp($number, $code) === 0)
                return;
          }
        }

        $this->addError($model, $attribute, 'Поддерживаются только операторы: ' . implode(', ', $this->operators));
    }

    private function getCode($number)
    {
      if (strlen($number) == 12 && substr($number, 0, 2) == '+7')
      {
        return substr($number, 2, 3);
      }
      elseif (strlen($number) == 11 && substr($number, 0, 1) == '8')
      {
        return substr($number, 1, 3);
      }

      return false;
    }
}
