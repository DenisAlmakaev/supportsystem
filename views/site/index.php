<?php

/* @var $model app\models\Requests  */


use yii\bootstrap4\ActiveForm;
use yii\helpers\url;
use yii\bootstrap4\Html;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */

$this->title = 'Support system';

?>


 <div class="container-content">
    <div class="page-header">
       <h2>
          Портал системы поддержки пользователей банка
        </h2>
    </div>
<div class="content-body">
    <h4>Добро пожаловать в систему поддержки пользователей!</h4>
    <h5>Здесь вы можете оставить заявку, выполнить регистрацию в системе или восстановить забытый пароль.</h5>
  </div>
<div class="card-deck">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Создать заявку</h5>
      <p class="card-text">без аккаунта</p>
    </div>
<div class="card-footer">
    <?= Html::a('Создать заявку', ['/requests/create']) ?>
    <i class="fa-solid fa-angles-right"></i>
    </div>
</div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Регистрация</h5>
      <p class="card-text">если у вас нет аккаунта</p>
    </div>
<div class="card-footer">
      <?= Html::a('Регистрация', ['/signup']) ?>
     <i class="fa-solid fa-angles-right"></i>
    </div>
  </div>
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Забыли пароль?</h5>
      <p class="card-text">Восстановление пароля</p>
    </div>
<div class="card-footer">
      <?= Html::a('Восстановить', ['site/request-password-reset']) ?>
    <i class="fa-solid fa-angles-right"></i>
    </div>
  </div>
<div class="card">
        <div class="card-body">
      <h5 class="card-title">Войти</h5>
      <p class="card-text">если у вас есть аккаунт</p>
    </div>
<div class="card-footer">
      <?= Html::a('Войти', ['/login']) ?>
    <i class="fa-solid fa-angles-right"></i>
</div>
   </div>
</div>

<div class="req-form">
    <h4>Создать заявку:</h4>
<div class="row">
    <div class="col-lg-6">

        <?php if ( Yii:: $app->session->hasFlash('success') ): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <?php echo Yii::$app->session->getFlash('success');?>
            </div>
        <?php endif;?>

        <?php if ( Yii:: $app->session->hasFlash('error') ): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <?php /*echo Yii::$app->session->getFlash('error');*/?>
            </div>
        <?php endif;?>

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
                'fileUpload' => Url::to(['/site/save-redactor-file', 'sub'=>'requests']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                ]
            ]
        ]);
        ?>


        <div class="form-group">
            <div class="text-right">


                <?=  Html::a('Отмена', ['index'], ['class' => 'btn btn-default']); ?>
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'requests-button']); ?>

            </div>
        </div>


        <?php ActiveForm::end(); ?>

        </div>
      </div>

    <div class="page-contact">
        <h3>Наши контакты:</h3>
        <h5>
            <i class="fas fa-phone-square-alt"></i>
            Телефон: +7(999)999-99-99
        </h5>
        <h5>
            <i class="fa-regular fa-envelope"></i>
            E-mail: support@company.ru
        </h5>
        <h5>
            <i class="fa-regular fa-clock"></i>
            Часы работы: 24/7
        </h5>
    </div>
    </div>








