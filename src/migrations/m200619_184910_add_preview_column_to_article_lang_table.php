<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%article_lang}}`.
 */
class m200619_184910_add_preview_column_to_article_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%article_lang}}', 'preview', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%article_lang}}', 'preview');
    }
}
