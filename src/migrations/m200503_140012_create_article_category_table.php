<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_category}}`.
 */
class m200503_140012_create_article_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_category}}', [
            'id' => $this->primaryKey(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'status'=> $this->integer(3)->notNull()->defaultValue(1),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ]);
        $this->createIndex('lft', '{{%article_category}}', ['lft', 'rgt']);
        $this->createIndex('rgt', '{{%article_category}}', ['rgt']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_category}}');
    }
}
