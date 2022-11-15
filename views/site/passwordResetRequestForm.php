<?php
 
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var yii\web\View $this */
/* @var $model app\models\PasswordResetRequestForm*/
 
$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset" xmlns="http://www.w3.org/1999/html">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>Пожалуйста, заполните актуальный адрес электронной почты.
        <br> Туда будет направлена ссылка для сброса пароля.</p>
    <div class="row">
        <div class="col-lg-4">

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div class="text-right">

                    <?=  Html::a('Отмена', ['index'], ['class' => 'btn btn-default']); ?>
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'request-password-reset-form']); ?>

                </div>
            </div>

            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>