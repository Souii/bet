<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
      <div class="container">

          <table class="table">
            <thead>
              <tr>
                <th scope="col">Team 1</th>
                <th scope="col">Start date</th>
                <th scope="col">Team 2</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($matches as $match): ?>
              <tr>
                <td><?=$match->team_1?></td>
                <td><?=$match->getDate()?> | <?=$match->getTime()?></td>
                <td><?=$match->team_2?></td>
              </tr>

            <?php endforeach;?>
            </tbody>
          </table>
      </div>




    </div>
</div>
