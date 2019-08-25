<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'My Yii Application';
?>
<div class="site-matches">

  <?php foreach ($matches as $match):?>
        <div class="row">
          <div class="col-lg-5">
              <div align="left">
                <br><br>
                  <p><?= $match->details->first_team ?>: x<?= $match->first_team_coef ?></p>
                  <p></p>
              </div>
          </div>

          <div class="col-lg-2">
              <div align="center">
                  <p><?= $match->getDate() ?></p>
                  <p><?= $match->getTime() ?></p>
                  <p>Ничья: x<?= $match->draw_coef ?></p>
                  <?php if ($match->isLive()):?>
                    <p>Счет: <?=$match->details->first_team_score?> - <?=$match->details->second_team_score?></p>
                  <?php endif?>

            <?php if ($match->canBet()): ?>
                  <p><?= Html::a('Bet', ['/bet/first-step', 'id' => $match->id], ['class' => 'btn btn-success'])?></p>
            <?php endif; ?>
              </div>
          </div>

          <div class="col-lg-5">
              <div align="right">
                <br><br>
                  <p><?= $match->details->second_team ?>: x<?= $match->second_team_coef ?></p>
              </div>
          </div>
        </div>
        <hr>
  <?php endforeach; ?>


</div>
