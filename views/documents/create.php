<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Добавить документ';
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="documents-create">
        <h5><?= Html::encode($this->title) ?></h5>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>








