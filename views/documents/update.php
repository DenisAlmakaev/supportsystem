<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Documents */


//$this->title = 'Редактировать документ: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="documents-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('change', [
        'model' => $model,
    ]) ?>
</div>