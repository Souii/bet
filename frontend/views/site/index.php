<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'My Yii Application';
?>
<div class="site-index">

  <div class="jumbotron">
    <h1>Добро пожаловать на Yiibet!</h1>

    <p class="lead">Выберите вид спорта.</p>
</div>

<div>
    <?php foreach ($categories as $category): ?>
        <div class="col-lg-5" style="margin: 1em; padding-left: 10%">
            <?= Html::img("@web/images/$category->name.png", ['alt' => $category->name, 'width' => 300, 'height' => 300]) ?>

            <?php
                Modal::begin([
                    'header' => '<h2>Внимание!</h2>',
                    'toggleButton' => [
                        'label' => "<h3>$category->name</h3>",
                        'tag' => 'a',
                    ],
                ]);
            ?>
            <p>Переходя по ссылке, вы подтверждаете, что вам исполнилось 18 лет
            и вы ознакомлены с <a href="/site/terms">Пользовательским соглашением</a></p>

            <a href="/site/matches?category=<?=$category->id?>" class="btn btn-success">Подтвердить и перейти</a>

            <?php Modal::end(); ?>
        </div>
    <?php endforeach; ?>
</div>
</div>
