<?php

use afashio\articles\models\Article;
use afashio\articles\models\ArticleCategory;
use afashio\language\models\Language;
use afashio\pushHelpers\utils\ImageUtil;
use afashio\pushHelpers\utils\PreviewUtil;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#common" href="#">
                    <?= Yii::t('app', 'Общие'); ?>
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#image" href="#">
                    <?= Yii::t('app', 'Изображения'); ?>
                </a>
            </li>
            <? foreach (Language::languageList() as $language): ?>
                <li role="presentation"><a data-toggle="tab" href="#<?= $language->slug; ?>"><?= $language->name; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="common">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6"><?= $form->field($model, 'article_category_id')->dropDownList
                            (
                                ArrayHelper::map(
                                    ArticleCategory::getList(),
                                    'id',
                                    'name'
                                )
                            ) ?></div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'order')->textInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'status')->dropDownList(Article::status_list()) ?>
                        </div>
                    </div>
                </div>
            </div>

            <? foreach (Language::languageList() as $language): ?>
                <div role="tabpanel" class="tab-pane" id="<?= $language->slug; ?>">
                    <div class="box-body">
                        <?= $form->field($model->translate($language->slug), "[$language->slug]title")->textInput(); ?>

                        <?= $form->field($model->translate($language->slug), "[$language->slug]preview")->widget(
                            \vova07\imperavi\Widget::class,
                            [
                                'settings' => [
                                    'lang' => Yii::$app->language,
                                    'minHeight' => 200,
                                    'imageUpload' => \yii\helpers\Url::to(['content-image-upload']),
                                    'plugins' => [
                                        'fullscreen',
                                        'imagemanager',
                                    ],
                                ],
                            ]
                        ) ?>

                        <?= $form->field($model->translate($language->slug), "[$language->slug]text")->widget(
                            \vova07\imperavi\Widget::class,
                            [
                                'settings' => [
                                    'lang' => Yii::$app->language,
                                    'minHeight' => 200,
                                    'imageUpload' => \yii\helpers\Url::to(['content-image-upload']),
                                    'plugins' => [
                                        'fullscreen',
                                        'imagemanager',
                                    ],
                                ],
                            ]
                        ) ?>

                        <?= \notgosu\yii2\modules\metaTag\widgets\metaTagForm\Widget::widget(
                            ['model' => $model, 'language' => $language->slug]
                        ); ?>
                    </div>
                </div>
            <? endforeach; ?>

            <div role="tabpanel" class="tab-pane" id="image">
                <div class="box-body">
                    <?= $form->field($model, 'image')->widget(
                        \kartik\file\FileInput::class,
                        [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' =>
                                    ImageUtil::getImageUrls($model)
                                ,
                                'initialPreviewConfig' =>
                                    PreviewUtil::getPreviewOptions(
                                        \yii\helpers\Url::to(['site/delete-image']),
                                        $model->getImages()
                                    ),
                                'initialPreviewAsData' => true,
                                'overwriteInitial' => false,
                            ],
                        ]
                    ); ?>
                </div>
            </div>

        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

