<?php



use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use vova07\imperavi\Widget;
use yii\helpers\Url;



/* @var $model app\models\Requests */


?>



<?php
$this->registerJs(
    "$('#requests-modal').modal('show');",
    yii\web\View::POS_READY
);
?>



<?php
Modal::begin([

    'title'=>'<h5>Создать заявку</h5>',
    'id'=>'requests-modal',

//    'size' => 'modal-lg',
]);
?>



<p>Пожалуйста заполните форму заявки:</p>

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

<?= $form->field($model, 'text')->widget(Widget::class, [
'settings' => [
'lang' => 'ru',
'minHeight' => 100,
'fileUpload' => Url::to(['/requests/save-redactor-file', 'sub'=>'requests']),
'plugins' => [
'clips',
'fullscreen',
       ]
    ]
]);
?>



<div class="form-group">
    <div class="text-right">

        <?php
        echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'requests-button']);
        ?>

    </div>
</div>

<?php ActiveForm::end(); ?>

<?php Modal::end(); ?>


