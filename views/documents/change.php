<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;


/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */

?>


<div class="col-lg-7">

    <h3>Пожалуйста внесите изменения в документ:</h3>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->input('text') ?>
    <?= $form->field($model, 'forms')->dropDownList([
        'Распоряжение (приказ)' => 'Распоряжение (приказ)',
        'Расчетный (платежный) документ' => 'Расчетный (платежный) документ',
        'Бухгалтерский и кассовый документ' => 'Бухгалтерский и кассовый документ',
        'Форма банковской отчетности' => 'Форма банковской отчетности',
        'Уведомление о закрытии счета' => 'Уведомление о закрытии счета',
        'Отчет о движении средств' => 'Отчет о движении средств',
    ]);
    ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'file')->widget(FileInput::class,
        [
            'options' => ['accept' => 'file/*'],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i>',
                'browseLabel' => 'Выбрать файл'
            ]]
    );

    ?>

    <div class="form-group">
        <div class="text-right">

            <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-default']) ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'documents-button']) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
