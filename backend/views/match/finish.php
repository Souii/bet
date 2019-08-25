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

              <?= $form->field($model, 'firstTeamScore')?>

              <?= $form->field($model, 'secondTeamScore')?>

                  <?= $form->field($model, 'outcome')->radioList(array_combine($match->getOutcomes(),$match->getOutcomes()))?>

              <div class="form-group">
                  <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
              </div>

          <?php ActiveForm::end(); ?>
        </div>
    </div>
