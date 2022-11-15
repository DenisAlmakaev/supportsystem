<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use vova07\imperavi\Widget;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="documents-form">
    <div class="row">
         <div class="col-8">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->input('text', ['placeholder' => "Введите имя документа"]) ?>
             <?= $form->field($model, 'forms')->dropDownList([
                 'Распоряжение (приказ)' => 'Распоряжение (приказ)',
                 'Расчетный (платежный) документ' => 'Расчетный (платежный) документ',
                 'Бухгалтерский и кассовый документ' => 'Бухгалтерский и кассовый документ',
                 'Форма банковской отчетности' => 'Форма банковской отчетности',
                 'Уведомление о закрытии счета' => 'Уведомление о закрытии счета',
                 'Отчет о движении средств' => 'Отчет о движении средств',
             ]);
             ?>



    <?= $form->field($model, 'description')->widget(Widget::class, [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 100,
//            'fileUpload' => Url::to(['/documents/save-redactor-file', 'sub'=>'documents']),
            'plugins' => [
                'clips',
                'fullscreen',
            ]
        ]
    ]);

    ?>

    <?= $form->field($model, 'file')->widget(FileInput::class,
        [
            'options' => ['accept' => 'file/*'],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
//                'browseClass' => 'btn btn-primary btn-block',
//                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i>',
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
    </div>
</div>









