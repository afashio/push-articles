<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \afashio\articles\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Статьи');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Добавить статью'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{items}\n{summary}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'title',
                    'status',
                    [
                        'attribute' => 'created_at',
                        'value' => 'created_at',
                        'format' => 'date',
                        'filter' => \kartik\daterange\DateRangePicker::widget(
                            [
                                'name' => 'created_at',
                                'pluginOptions' => [
                                    'locale' => [
                                        'format' => 'd-M-y',
                                        'separator' => ' to ',
                                    ],
                                ],
                                'convertFormat' => true,
                            ]
                        ),

                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => 'updated_at',
                        'format' => 'date',
                        'filter' => \kartik\daterange\DateRangePicker::widget(
                            [
                                'name' => 'created_at',
                                'pluginOptions' => [
                                    'locale' => [
                                        'format' => 'd-M-y',
                                        'separator' => ' to ',
                                    ],
                                ],
                                'convertFormat' => true,
                            ]
                        ),

                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]
        ); ?>
    </div>
</div>
