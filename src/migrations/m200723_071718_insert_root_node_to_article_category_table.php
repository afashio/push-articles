<?php

use afashio\articles\models\ArticleCategory;
use yii\db\Migration;

/**
 * Class m200723_071718_insert_root_node_to_article_category_table
 */
class m200723_071718_insert_root_node_to_article_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert(
            ArticleCategory::tableName(),
            [
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
                'slug' => 'root-node',
                'status' => 2,
                'created_at' => new \yii\db\Expression('NOW()'),
                'updated_at' => new \yii\db\Expression('NOW()'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200723_071718_insert_root_node_to_article_category_table cannot be reverted.\n";

        return true;
    }
}
