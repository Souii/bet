<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Yiibet Dashboard';
?>
<div class="site-index">
    <h1>Панель администратора</h1>
    <hr/>
    <div class="col-lg-3" style="border:0.1em solid black; padding: 1em; margin: 0.5em">
        <h3>Виды спорта</h3>
        <?= Html::a('Список', ['/category'], ['class' => 'btn btn-primary']) ?>
        <hr/>
        <?= Html::a('+ Добавить категорию', ['/category/add'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="col-lg-4" style="border:0.1em solid black; padding: 1em; margin: 0.5em">
        <h3>Матчи</h3>
        <?= Html::a('Список', ['/match'], ['class' => 'btn btn-primary']) ?>
        <hr/>
        <?= Html::a('+ Добавить матч', ['/match/add'], ['class' => 'btn btn-success']) ?>
    </div>


</div>
