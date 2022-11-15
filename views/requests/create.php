<?php

use yii\bootstrap4\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Requests */


$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requests-create">

    <h5><?= Html::encode($this->title) ?></h5>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
