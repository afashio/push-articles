<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m191111_121309_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'order' => $this->integer(11)->notNull(),
            'slug' => $this->string(50)->unique()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
