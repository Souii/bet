<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Пользовательское соглашение';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Здесь будет текст пользовательского соглашения</p>

    <p>Вы также можете <?php echo Html::a('скачать', ["@web/Пользовательское соглашение.docx"]) ?></p>
</div>
