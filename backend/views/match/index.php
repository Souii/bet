<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все матчи';
?>
<div class="match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить матч', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Вид спорта</th>
                <th scope="col">Первая команда</th>
                <th scope="col">Вторая команда</th>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
                <th scope="col">Статус</th>
                <th scope="col">Live</th>
                <th scope="col">Действия</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($matches as $match): ?>

              <tr>
                <td><?=$match->category->name?></td>
                <td><?=$match->details->first_team?></td>
                <td><?=$match->details->second_team?></td>
                <td><?=$match->getDate()?></td>
                <td><?=$match->getTime()?></td>
                <td><?=$match->status?></td>
                <td><?= $match->isLiveValue()?></td>
                <td><?=$this->render('actions', ['match' => $match])?></td>
              </tr>

            <?php endforeach;?>
            </tbody>
          </table>

</div>
