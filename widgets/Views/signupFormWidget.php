<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */
/* @var $form yii\widgets\ActiveForm */



Modal::begin([

    'title'=>'<h5>Регистрация</h4>',
    'id'=>'signup-modal',
]);
?>


<p>Для регистрации заполните следующие поля:</p>

<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-signup']
]);
echo $form->field($model, 'username')->textInput(['placeholder' => "Введите ваше имя"]);
echo $form->field($model, 'email')->textInput(['placeholder' => "Введите существующий е-майл"]);
echo $form->field($model, 'password')->passwordInput(['placeholder' => "Введите пароль"]);
?>

    <div class="form-group">
        <div class="text-right">

<?php
echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
echo Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'signup-button']);
?>

        </div>
    </div>

<?php
ActiveForm::end();
Modal::end();