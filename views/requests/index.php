<?php

use app\models\Requests;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;





/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile("@web/css/index.css");


$this->title = 'Просмотр заявок';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?=Yii::$app->user->id ?> (<?=Yii::$app->user->identity->username?>) </h2>

<div class="requests-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'showHeader' => false, // вырезаем шапку таблицы
//        'showOnEmpty' => false,
//         'pager' => [
//             'firstPageLabel' => 'Назад',
//             'lastPageLabel' => 'Следующая',
//                ],
        'summary' => 'страницы {page} из {pageCount}',
        'tableOptions' => [
            'class' => 'table' // можно задать свой, тут 100% ширина блока
        ],
        'options' => ['tag' => 'div', 'class' => 'col-lg-12'], // оборачиваем в div с Bootstrap CSS
       'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
            'theme',
            'email:email',
            'category',
            'service',
            'priority',
            'text:ntext',
            'filename',
            'created_at',
            'updated_at',


            [
                'class' => ActionColumn::class,
                'header' => 'Действия',
                'headerOptions' => ['width' => '120'],
                'template' => '{view} {send}',
                'buttons' =>[
                        'send'=>function($url, $model, $key) {
                                return Html::a('Отправить в работу', $url,);
                        }
                ],
                'urlCreator' => function ($action, Requests $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],


        ],

    ]); ?>


    <?php Pjax::end(); ?>

</div>