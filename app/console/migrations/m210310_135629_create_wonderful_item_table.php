<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wonderful_item}}`.
 */
class m210310_135629_create_wonderful_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wonderful_item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wonderful_item}}');
    }
}
