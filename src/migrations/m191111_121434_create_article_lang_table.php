<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_lang}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%article}}`
 */
class m191111_121434_create_article_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_lang}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'language' => $this->string(50)->notNull(),
            'title' => $this->string(150)->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        // creates index for column `article_id`
        $this->createIndex(
            '{{%idx-article_lang-article_id}}',
            '{{%article_lang}}',
            'article_id'
        );

        // add foreign key for table `{{%article}}`
        $this->addForeignKey(
            '{{%fk-article_lang-article_id}}',
            '{{%article_lang}}',
            'article_id',
            '{{%article}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%article}}`
        $this->dropForeignKey(
            '{{%fk-article_lang-article_id}}',
            '{{%article_lang}}'
        );

        // drops index for column `article_id`
        $this->dropIndex(
            '{{%idx-article_lang-article_id}}',
            '{{%article_lang}}'
        );

        $this->dropTable('{{%article_lang}}');
    }
}
