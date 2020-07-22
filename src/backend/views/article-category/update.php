<?php


/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\ArticleCategory */

$this->title = 'Обновить категорию статей: ' . $model->translate()->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории услуг', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->translate()->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="service-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
