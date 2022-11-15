<?php


use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;


/* @var $model app\models\Requests */

?>

<div class="col-lg-7">

    <h3>Пожалуйста внесите изменения в форму заявки:</h3>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field ($model, 'theme')->input('text', ['placeholder' => "Введите тему обращения"]) ?>
<?= $form->field ($model, 'email')->input('email', ['placeholder' => "Введите существующий email"]) ?>
<?= $form->field($model, 'service')->dropDownList([
    'Обслуживание внутренних клиентов' => 'Обслуживание внутренних клиентов',
    'Обслуживание сторонних клиентов' => 'Обслуживание сторонних клиентов',
    'Иное' => 'Иное'
]);
?>
<?= $form->field($model, 'category')->dropDownList([
    'Заявка на обслуживание' => 'Заявка на обслуживание',
    'Ремонт оргтехники' => 'Ремонт оргтехники',
    'Проблемы с удаленным доступом к АРМ' => 'Проблемы с удаленным доступом к АРМ',
    'Заказ транспорта'=>'Заказ транспорта',
    'Инцидент'=>'Инцидент'
]);
?>
<?= $form->field($model, 'priority')->dropDownList([
    'Низкий' => 'Низкий',
    'Средний' => 'Средний',
    'Высокий' => 'Высокий',
    'Критический'=>'Критический',
]);
?>


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
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'requests-button']) ?>

        </div>
    </div>

<?php ActiveForm::end(); ?>

</div>

