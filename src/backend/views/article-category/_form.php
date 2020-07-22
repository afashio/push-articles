<?php

use afashio\pushHelpers\helpers\FormHelper;
use afashio\language\models\Language;
use afashio\articles\models\ArticleCategory;
use afashio\pushHelpers\utils\ImageUtil;
use afashio\pushHelpers\utils\PreviewUtil;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \afashio\articles\models\ArticleCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-category-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a data-toggle="tab" href="#common" href="#">
                    <?= Yii::t('app', 'Общие'); ?>
                </a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" href="#images" href="#">
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
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'status')->dropDownList(ArticleCategory::status_list()) ?>
                </div>
            </div>

            <? foreach (Language::languageList() as $language): ?>
                <div role="tabpanel" class="tab-pane" id="<?= $language->slug; ?>">
                    <div class="box-body">
                        <?= \notgosu\yii2\modules\metaTag\widgets\metaTagForm\Widget::widget(
                            ['model' => $model, 'language' => $language->slug]
                        ); ?>
                        <?= $form->field($model->translate($language->slug), "[$language->slug]name")->textInput(); ?>
                        <?= $form->field($model->translate($language->slug), "[$language->slug]text")->widget(
                            FormHelper::textEditorWidgetClass(),
                            FormHelper::textEditorConfig()
                        ) ?>
                    </div>
                </div>
            <? endforeach; ?>
            <div role="tabpanel" class="tab-pane" id="images">
                <div class="box-body">
                    <?= $form->field($model, 'imageFiles')->widget(
                        \kartik\file\FileInput::class, [
                        'options' => ['accept' => 'image/*', 'multiple' => false],
                        'pluginOptions' => [
                            'initialPreview' =>
                                ImageUtil::getImageUrls($model)
                            ,
                            'initialPreviewConfig' =>
                                PreviewUtil::getPreviewOptions(
                                    \yii\helpers\Url::to(['site/delete-image']), $model->getImages()
                                ),
                            'initialPreviewAsData' => true,
                            'overwriteInitial' => false,
                        ],
                    ]
                    ); ?>
                </div>
            </div>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
