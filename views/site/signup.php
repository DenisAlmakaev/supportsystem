<?php
 
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


/* @var $model app\models\SignupForm */
/** @var yii\web\View $this */
 
$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-signup">
    <h3><?= Html::encode($this->title) ?></h3>
    <p>Для регистрации заполните следующие поля:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'signup-form-']); ?>
                <?= $form->field($model, 'username')->textInput(['placeholder' => "Введите ваше имя"]) ?>
                <?= $form->field($model, 'email') ->textInput(['placeholder' => "Введите существующий е-майл"]) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Введите пароль"]) ?>

            <div class="form-group">
                <div class="text-right">

                    <?=  Html::a('Отмена', ['index'], ['class' => 'btn btn-default']); ?>
                    <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>

                </div>
            </div>
        </div>
    </div>
</div>

            <?php ActiveForm::end(); ?>

