<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Bet;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="row">
        <div class="col-lg-5  col-md-offset-4 text-center">
            <?php $form = ActiveForm::begin(); ?>

                <div class="form-group">
                  <?= $form->field($model, 'agree')->checkbox(['label' => 'Я согласен с условиями пользовательского соглашения', 'checked' => true]) ?>
                  <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
