<?php


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */


$this->title = 'Войти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Для входа заполните следующие поля:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'login-form']);
            echo $form->field($model, 'email')->textInput(['placeholder' => "Введите существующий е-майл"]);
            echo $form->field($model, 'password')->passwordInput(['placeholder' => "Введите пароль"]);
            ?>


    <div>
        Если вы забыли пароль, Вы можете <?= Html::a('восстановить его', ['site/request-password-reset']) ?>.
    </div>

    <div class="form-group">
        <div class="text-right">

            <?=  Html::a('Отмена', ['index'], ['class' => 'btn btn-default']); ?>
            <?=  Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>

               </div>
           </div>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>



