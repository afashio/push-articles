<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\Article */

$this->title = Yii::t('app', 'Добавить статью');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статьи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
