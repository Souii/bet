<?php

use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
?>
<div class="match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add category', ['add'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="col-md-2">
      <table class="table">
            <tbody>
              <?php foreach ($categories as $category): ?>

              <tr>
                  <td><a href="<?= Url::to('/category/edit?id='. $category->id)?>"><?= $category->name ?></a></td>
              </tr>

            <?php endforeach;?>
            </tbody>
          </table>
    </div>



</div>
