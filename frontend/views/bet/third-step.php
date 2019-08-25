

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
                <th scope="col" class="text-center"><?=$match->details->first_team?>: x<?=$match->first_team_coef?></th>
                <th scope="col" class="text-center">Ничья: x<?= $match->draw_coef ?></th>
                <th scope="col" class="text-center"><?=$match->details->second_team?>: x<?=$match->second_team_coef?></th>
              </tr>
            </thead>
          </table>
          <p align="center">Исход: <?=$outcome?></p>
          <p align="center">Сумма: <?=$amount?></p>
          <p align="center">Сумма в случае выигрыша: <?=$amount * $coef?></p>
        </div></div>

    <div class="row">
        <div class="col-md-4  col-md-offset-4 text-center">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'agree')->checkbox(['label' => 'Я согласен с условиями пользовательского соглашения', 'checked' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Продолжить', ['class' => 'btn btn-primary', 'name' => 'confirm-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
