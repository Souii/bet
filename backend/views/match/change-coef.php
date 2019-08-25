<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Bet;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="row">
        <div class="col-md-4">
          <?php $form = ActiveForm::begin(); ?>

          <?= $form->field($model, 'firstTeamCoef')->textInput() ?>

          <?= $form->field($model, 'secondTeamCoef')->textInput() ?>

          <?= $form->field($model, 'drawCoef')->textInput() ?>

              <div class="form-group">
                  <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
              </div>

          <?php ActiveForm::end(); ?>
        </div>
    </div>
