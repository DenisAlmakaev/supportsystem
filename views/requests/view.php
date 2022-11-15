<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Requests */


$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="requests-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <h2><?=Yii::$app->user->id ?> (<?=Yii::$app->user->identity->username?>) </h2>
    <?php if (Yii::$app->user->can('updatePost', ['author_id' => $model->user_id])): ?>


    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'theme',
            'email:email',
            'category',
            'service',
            'priority',
            'text:ntext',
            'filename',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
