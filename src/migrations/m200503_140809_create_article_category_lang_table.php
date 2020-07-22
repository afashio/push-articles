<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_category_lang}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%article_category}}`
 */
class m200503_140809_create_article_category_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_category_lang}}', [
            'id' => $this->primaryKey(),
            'language' => $this->string(255)->notNull(),
            'text' => $this->text(),
            'name' => $this->string(255),
            'article_category_id' => $this->integer(),
        ]);

        // creates index for column `article_category_id`
        $this->createIndex(
            '{{%idx-article_category_lang-article_category_id}}',
            '{{%article_category_lang}}',
            'article_category_id'
        );

        // add foreign key for table `{{%article_category}}`
        $this->addForeignKey(
            '{{%fk-article_category_lang-article_category_id}}',
            '{{%article_category_lang}}',
            'article_category_id',
            '{{%article_category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%article_category}}`
        $this->dropForeignKey(
            '{{%fk-article_category_lang-article_category_id}}',
            '{{%article_category_lang}}'
        );

        // drops index for column `article_category_id`
        $this->dropIndex(
            '{{%idx-article_category_lang-article_category_id}}',
            '{{%article_category_lang}}'
        );

        $this->dropTable('{{%article_category_lang}}');
    }
}
