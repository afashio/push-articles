<?php

use afashio\articles\models\ArticleCategory;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\ArticleCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-category-view box box-primary">
    <div class="box-header">
        <?= Html::a('Оновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(
            'Удалить',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger btn-flat',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите безвозвратно удалить категорию статей?',
                    'method' => 'post',
                ],
            ]
        ) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget(
            [
                'model' => $model,
                'attributes' => [
                    'id',
                    'slug',
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return ArticleCategory::getStatus($data->status);
                        },
                    ],
                    [
                        'label' => 'Название категории',
                        'attribute' => 'name',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]
        ) ?>
    </div>
</div>
