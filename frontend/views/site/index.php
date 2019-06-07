<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
        <?php foreach ($matches as $match): ?>
          <p><?=$match->team_1?> <b><?=$match->start_date?> </b> <?=$match->team_2?> </p>
        <?php endforeach;?>

    </div>
</div>
