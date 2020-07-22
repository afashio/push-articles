<?php

namespace afashio\articles\models;

use Yii;

/**
 * This is the model class for table "article_lang".
 *
 * @property int $id
 * @property int $article_id
 * @property int $language
 * @property string $title
 * @property string $text
 * @property string $preview
 *
 * @property Article $article
 */
class ArticleLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'title', 'text'], 'required'],
            [['article_id'], 'integer'],
            [['text', 'preview'], 'string'],
            [['language'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['language'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['language' => 'slug']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'language' => Yii::t('app', 'Language'),
            'title' => Yii::t('app', 'Название'),
            'text' => Yii::t('app', 'Текст'),
            'preview' => Yii::t('app', 'Анонс'),
        ];
    }


    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }
}
