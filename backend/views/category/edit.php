<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактировать категорию';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($category, 'name')->textInput()->label('Название') ?>

	<div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
