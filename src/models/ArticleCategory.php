<?php

namespace afashio\articles\models;

use afashio\articles\queries\AbstractCategoryQuery;
use afashio\language\models\Language;
use afashio\pushHelpers\traits\BasicStatusTrait;
use afashio\pushHelpers\traits\ModelTranslationTrait;
use creocoder\translateable\TranslateableBehavior;
use notgosu\yii2\modules\metaTag\components\MetaTagBehavior;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use rico\yii2images\behaviors\ImageBehave;

/**
 * This is the model class for table "service_category".
 *
 * @property int                   $id
 * @property int                   $lft
 * @property int                   $rgt
 * @property int                   $depth
 * @property string                $slug
 * @property int                   $status
 * @property string|null           $created_at
 * @property string|null           $updated_at
 *
 * @property \yii\db\ActiveQuery   $translations
 * @property string                $nameAndStatus
 * @property ArticleCategoryLang[] $serviceCategoryLangs
 *
 * @mixin \afashio\articles\models\ArticleCategoryLang
 * @mixin TranslateableBehavior
 * @mixin NestedSetsBehavior
 * @mixin ImageBehave
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    use BasicStatusTrait;
    use ModelTranslationTrait;

    public $imageFiles;

    /**
     * @return AbstractCategoryQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new AbstractCategoryQuery(static::class);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => NestedSetsBehavior::class,
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],

            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => ['name', 'text'],
                'translationLanguageAttribute' => 'language',
            ],
            'seo' => [
                'class' => MetaTagBehavior::class,
                'languages' => Language::languageNameArray(),
            ],
            'image' => [
                'class' => ImageBehave::class,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['status'], 'integer'],
            [['slug', 'created_at', 'updated_at'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'slug' => 'Slug',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'imageFiles' => 'Изображения'
        ];
    }

    /**
     * Gets query for [[ServiceCategoryLangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations(): \yii\db\ActiveQuery
    {
        return $this->hasMany(ArticleCategoryLang::class, ['article_category_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->translate(\Yii::$app->language)->name;
    }

    /**
     * @return string
     */
    public function getNameAndStatus():string
    {
        return $this->translate()->name . ' ' . self::status_list()[$this->status];
    }

    /**
     * @return array
     */
    public static function getList(): array
    {
        return static::find()->all();
    }
}
