<?php

use app\models\Documents;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile("@web/css/index.css");

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
        //        'showHeader' => false, // вырезаем шапку таблицы
        //        'showOnEmpty' => false,
        'pager' => [
            'firstPageLabel' => 'Назад',
            'lastPageLabel' => 'Следующая',
        ],
        'summary' => 'страницы {page} из {pageCount}',
        'tableOptions' => [
            'class' => 'table table-striped' // можно задать свой, тут 100% ширина блока
        ],
        'options' => ['tag' => 'div', 'class' => 'col-lg-10'], // оборачиваем в div с Bootstrap CSS


        'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
            'name',
            'forms',
            'description',
            'created_at',
            'updated_at',
            'filename',
            [
                'label'=>'Скачать файл (в стадии разработки)',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a('Скачать файл', [' ']);
                },
            ],

              [
                  'class' => ActionColumn::class,
                  'header' => 'Действия',
                  'headerOptions' => ['width' => '80'],
                  'template' => '{view}',
                  'urlCreator' => function ($action, Documents $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
    ]

    ]);

    ?>


    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::end(); ?>
</div>