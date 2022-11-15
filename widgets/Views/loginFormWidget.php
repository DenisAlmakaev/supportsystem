<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form yii\widgets\ActiveForm */


Modal::begin([

    'title'=>'<h5>Войти</h5>',
    'id'=>'login-modal',
]);
?>

    <p>Для входа заполните следующие поля:</p>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'action' => ['site/ajax-login']
]);
echo $form->field($model, 'email')->textInput(['placeholder' => "Введите существующий е-майл"]);
echo $form->field($model, 'password')->passwordInput(['placeholder' => "Введите пароль"]);
echo $form->field($model, 'rememberMe')->checkbox();
?>

    <div>
        Если вы забыли пароль, Вы можете <?= Html::a('восстановить его', ['site/request-password-reset']) ?>.
    </div>
    <div class="form-group">
        <div class="text-right">

            <?php
            echo Html::button('Отмена', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']);
            echo Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']);
            ?>

        </div>
    </div>

<?php
ActiveForm::end();
Modal::end();