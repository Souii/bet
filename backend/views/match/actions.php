<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>


    <?php if ($match->canStart()):?>
      <a href="<?=Url::to('/match/start?id=' . $match->id)?>" class="btn btn-success">начать</a>
    <?php endif;?>
    <?php if ($match->isCurrent()):?>
      <a href="<?=Url::to('/match/set-live?id=' . $match->id)?>" class="btn btn-danger">Live</a>
    <?php endif;?>
    <?php if ($match->isLive()):?>
      <a href="<?=Url::to('/match/change-score?id=' . $match->id)?>" class="btn btn-primary">изменить счет</a>
        <a href="<?=Url::to('/match/change-coef?id=' . $match->id)?>" class="btn btn-primary">изменить коэффициент</a>
    <?php endif;?>
    <?php if ($match->canFinish()):?>
      <a href="<?=Url::to('/match/finish?id=' . $match->id)?>" class="btn btn-danger">закончить</a>
    <?php endif;?>
    <?php if ($match->canMove()):?>
      <a href="<?=Url::to('/match/move?id=' . $match->id)?>" class="btn btn-info">перенести</a>
    <?php endif;?>
    <?php if ($match->canCancel()):?>
      <a href="<?=Url::to('/match/cancel?id=' . $match->id)?>" class="btn btn-warning">отменить</a>
    <?php endif;?>
