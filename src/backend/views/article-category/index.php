<?php

use afashio\articles\models\ArticleCategory;
use yii\helpers\Html;
use voskobovich\tree\manager\widgets\nestable\Nestable;

/* @var $this yii\web\View */
/* @var $searchModel \afashio\articles\search\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории статей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-category-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Создать категорию статей', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive">
       <?= Nestable::widget([
               'modelClass' => ArticleCategory::class
       ])?>
    </div>
</div>
