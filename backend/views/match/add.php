<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="row">
        <div class="col-md-4">
          <?php $form = ActiveForm::begin(); ?>

              <?= $form->field($match, 'category')->dropDownList(ArrayHelper::map($categories, 'id', 'name')); ?>

              <?= $form->field($match, 'firstTeam')->textInput() ?>

              <?= $form->field($match, 'secondTeam')->textInput() ?>

              <?= $form->field($match, 'firstTeamCoef')->textInput() ?>

              <?= $form->field($match, 'secondTeamCoef')->textInput() ?>

              <?= $form->field($match, 'drawCoef')->textInput() ?>

              <?= $form->field($match, 'eventDate')->textInput(['type' => 'date']) ?>

              <?= $form->field($match, 'eventTime')->textInput(['type' => 'time']) ?>

              <div class="form-group">
                  <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
              </div>

          <?php ActiveForm::end(); ?>
        </div>
    </div>
