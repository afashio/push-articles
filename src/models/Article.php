<?php

namespace afashio\articles\models;

use afashio\language\models\Language;
use afashio\pushHelpers\traits\BasicStatusTrait;
use afashio\pushHelpers\traits\ModelTranslationTrait;
use creocoder\translateable\TranslateableBehavior;
use notgosu\yii2\modules\metaTag\components\MetaTagBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "article".
 *
 * @property int                 $id
 * @property int                 $order
 * @property string              $slug
 * @property int                 $status
 * @property string              $created_at
 * @property string              $text
 * @property string              $title
 * @property string              $updated_at
 * @property \common\models\ArticleCategory $articleCategory
 * @property integer             $article_category_id
 * @property array               $translations
 * @mixin \common\models\ArticleLang
 * @mixin \rico\yii2images\behaviors\ImageBehave
 */
class Article extends \yii\db\ActiveRecord
{
    use BasicStatusTrait;
    use ModelTranslationTrait;

    public const DEFAULT_ORDER_VALUE = 500;

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    public static function getActive()
    {
        return self::find()->andWhere(['status' => self::getActiveStatus()])->orderBy(['created_at' => 'DESC'])->all();
    }

    public static function findBySlug($slug)
    {
        return self::find()->andWhere(['slug' => $slug])->andWhere(['status' => self::getActiveStatus()])->one();
    }

    public function behaviors()
    {
        $behaviors = [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],

            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => ['title', 'text', 'preview'],
                // translationRelation => 'translations',
                'translationLanguageAttribute' => 'language',
            ],
            'seo' => [
                'class' => MetaTagBehavior::class,
                'languages' => Language::languageNameArray(),
                //'defaultFieldForTitle' => 'label'
            ],
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
        ];

        return array_merge(parent::behaviors(), $behaviors);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'slug', 'status', 'created_at', 'updated_at', 'article_category_id'], 'required'],
            [['order', 'status', 'article_category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug'], 'string', 'max' => 50],
            [['slug'], 'unique'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order' => Yii::t('app', 'Порядок отображения'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Статус'),
            'created_at' => Yii::t('app', 'Создана'),
            'updated_at' => Yii::t('app', 'Редактировано'),
            'title' => Yii::t('app', 'Название'),
            'article_category_id' => Yii::t('app', 'Категория статьи'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(ArticleLang::class, ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id', 'article_category_id']);
    }

    public static function getImportantForOwners()
    {
        return self::find()->andWhere(
            [
                'article_category_id' => 4,
                'status' => self::getActiveStatus(),
            ]
        )->limit(3)->orderBy(['id' => SORT_DESC])->all();
    }
}
