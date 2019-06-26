

<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Bet;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="row">
        <div class="col-md-4  col-md-offset-4 text-center">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'phone_number')->textInput(['placeholder' => '+7'])->hint('Сумма ставки списывается с баланса телефона.') ?>

                <?= $form->field($model, 'amount')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
