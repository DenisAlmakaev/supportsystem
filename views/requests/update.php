<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Requests */

//$this->title = 'Редактирование заявки: ' . ' ';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->theme, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="requests-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('change', [
        'model' => $model,
    ]) ?>

</div>
