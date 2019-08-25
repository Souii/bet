<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все ставки';
?>
<div class="match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Матч</th>
                <th scope="col">Номер телефона</th>
                <th scope="col">Сумма</th>
                <th scope="col">Исход</th>
                <th scope="col">Коэффициент</th>
                <th scope="col">Статус</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bets as $bet): ?>

              <tr>
                <td><?=$bet->match_id?></td>
                <td><?=$bet->phone_number?></td>
                <td><?=$bet->amount?></td>
                <td><?=$bet->outcome?></td>
                <td><?=$bet->coef?></td>
                <td><?=$bet->status?></td>
              </tr>

            <?php endforeach;?>
            </tbody>
          </table>

</div>
