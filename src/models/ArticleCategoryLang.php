<?php

namespace afashio\articles\models;

use Yii;

/**
 * This is the model class for table "service_category_lang".
 *
 * @property int             $id
 * @property string          $language
 * @property string|null     $text
 * @property string|null     $name
 * @property int|null        $service_category_id
 *
 * @property ArticleCategory $serviceCategory
 */
class ArticleCategoryLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_category_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['text'], 'string'],
            [['service_category_id'], 'integer'],
            [['language', 'name'], 'string', 'max' => 255],
            [['service_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['service_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
            'text' => 'Текст',
            'name' => 'Название (Заголовок страницы)',
            'service_category_id' => 'Service Category ID',
        ];
    }

    /**
     * Gets query for [[ServiceCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['id' => 'service_category_id']);
    }
}
