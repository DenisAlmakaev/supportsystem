<?php
 
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $model app\models\ResetPasswordForm */
/** @var yii\web\View $this */
 
$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="site-reset-password">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>Пожалуйста, введите новый пароль:</p>
    <div class="row">
        <div class="col-lg-3">
 
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div class="text-right">

                    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-default']); ?>
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'request-password-reset-form']); ?>

                </div>
            </div>

            <?php ActiveForm::end(); ?>
 
        </div>
    </div>
</div>