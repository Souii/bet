<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">
      <div class="container">

          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Команда 1</th>
                <th scope="col">Команда 2</th>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($matches as $match): ?>

              <tr>

                <td><?=$match->team_1?></td>
                <td><?=$match->team_2?></td>
                <td><?=$match->getDate()?></td>
                <td><?=$match->getTime()?></td>

                <td><a href="<?= Url::to(['bet/step-one/' . $match->id])?>" class="btn btn-primary m-0">Сделать ставку</a></td>

              </tr>

            <?php endforeach;?>
            </tbody>
          </table>
      </div>




    </div>
</div>
