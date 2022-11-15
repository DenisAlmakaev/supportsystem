<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use vova07\imperavi\Widget;

/* @var $model app\models\Requests */


?>

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>

    <?php
    $this->registerJs(
        "$('#myModalSendOk').modal('show');",
        yii\web\View::POS_READY
    );
    ?>

    <!-- Modal -->
    <div class="modal fade" id="myModalSendOk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal_header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="modal-title" id="myModalLabel">Форма обратной связи</h5>
                </div>
                <div class="modal-body">
                    <p>Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <div class="modal_header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть"><span aria-hidden="true">×</span></button>
                <h5 class="modal-title" id="myModalLabel">Заполните форму ниже и мы свяжемся с вами</h5>
            </div>
            <div class="modal-body">


                <?= $form->field($model, 'email')->textInput(['placeholder' => "Введите существующий е-майл"]) ?>

                <?= $form->field($model, 'body')->widget(Widget::class, [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 100,
                        'plugins' => [
                            'clips',
                            'fullscreen',
                        ]
                    ]
                ]);
                ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>