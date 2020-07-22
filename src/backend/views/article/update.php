<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\Article */

$this->title = 'Обновить статью: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' =>'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
