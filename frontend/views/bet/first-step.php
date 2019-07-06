<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\models\Bet;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col" class="text-center"><?=$match->team_1?></th>
              <th scope="col" class="text-center"><?=$match->getTime()?></th>
              <th scope="col" class="text-center"><?=$match->team_2?></th>
            </tr>
          </thead>
        </table>
      </div>


    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">

          <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'match_id')->hiddenInput(['value'=>$match->id])->label(false); ?>
            <?= $form->field($model, 'outcome')->radioList([
              Bet::OUTCOME_WIN_1 => $match->team_1,
              Bet::OUTCOME_WIN_2 => $match->team_2,
              Bet::OUTCOME_DRAW => 'Ничья'])?>

            <div class="form-group">
                <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
            </div>

          <?php ActiveForm::end(); ?>


        </div>
    </div>
