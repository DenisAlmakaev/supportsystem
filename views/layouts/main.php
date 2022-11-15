<?php

/** @var yii\web\View $this */
/** @var string $content */
/* @var $model app\models\Documents */

use app\assets\AppAsset;
use app\widgets\FBFWidget;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\widgets\LoginFormWidget;
use app\widgets\SignupFormWidget;





AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="icon" href="/web/icon.ico">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<?php if (Yii::$app->user->isGuest) {
    try {
        echo LoginFormWidget::widget([]);
    } catch (Exception $e) {
    }
} ?>
<?php if (Yii::$app->user->isGuest) {
    try {
        echo SignupFormWidget::widget([]);
    } catch (Exception $e) {
    }
} ?>


<header>


    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [

            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',

        ],
    ]);



   $menuItems = [
    ['label' => 'Главная', 'url' => ['/']],
    ['label' => 'Заявки', 'url' => ['/requests/index'],
       'options' => ['class' => 'dropdown'],
       'items' => [
                ['label' => 'Просмотр заявок', 'url' => ['/requests/index']],
                ['label' => 'Создать заявку',  'url' => ['/requests/create']],
            ],
        ],
    ['label' => 'Документы', 'url' => ['documents/index']],
    ['label' => 'Обратная связь', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#myModal']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Регистрация', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#signup-modal']];
    $menuItems[] = ['label' => 'Войти', 'url' => '#', 'options' => ['data-toggle' => 'modal', 'data-target' => '#login-modal']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['site/logout'])
        . Html::submitButton(
            'Выйти (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);

    NavBar::end();
    ?>
    
</header>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'] ?? [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container-fluid">
        <p class="float-left"> Алмакаев Денис &copy;<?= date('Y') ?></p>
        <p class="float-right"></p>
    </div>
</footer>

<?= FBFWidget::widget([]) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
