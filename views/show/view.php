<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Show */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'show_category_id',
            'cultural_place_id',
            'begin_date',
            'end_date',
            'start_hour',
            'start_min',
        ],
    ]) ?>

</div>
