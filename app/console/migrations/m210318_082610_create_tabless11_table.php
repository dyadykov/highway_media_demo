<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m210318_082610_create_tabless_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'price' => $this->decimal(10,2),
        ]);

        $this->createTable('{{%item_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('{{%item_to_group}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `item_id`
        $this->createIndex(
            '{{%idx-item_to_group-item_id}}',
            '{{%item_to_group}}',
            'item_id'
        );

        // add foreign key for table `{{%item}}`
        $this->addForeignKey(
            '{{%fk-item_to_group-item_id}}',
            '{{%item_to_group}}',
            'item_id',
            '{{%item}}',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            '{{%idx-item_to_group-group_id}}',
            '{{%item_to_group}}',
            'group_id'
        );

        // add foreign key for table `{{%item_group}}`
        $this->addForeignKey(
            '{{%fk-item_to_group-group_id}}',
            '{{%item_to_group}}',
            'group_id',
            '{{%item_group}}',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%item_type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('{{%item_to_type}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `item_id`
        $this->createIndex(
            '{{%idx-item_to_type-item_id}}',
            '{{%item_to_type}}',
            'item_id'
        );

        // add foreign key for table `{{%item}}`
        $this->addForeignKey(
            '{{%fk-item_to_type-item_id}}',
            '{{%item_to_type}}',
            'item_id',
            '{{%item}}',
            'id',
            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-item_to_type-type_id}}',
            '{{%item_to_type}}',
            'type_id'
        );

        // add foreign key for table `{{%item_type}}`
        $this->addForeignKey(
            '{{%fk-item_to_type-type_id}}',
            '{{%item_to_type}}',
            'type_id',
            '{{%item_type}}',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'data_paid' => $this->datetime()->notNull(),
        ]);

        $this->createTable('{{%order_to_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_to_item-order_id}}',
            '{{%order_to_item}}',
            'order_id'
        );

        // add foreign key for table `{{%order}}`
        $this->addForeignKey(
            '{{%fk-order_to_item-order_id}}',
            '{{%order_to_item}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        // creates index for column `item_id`
        $this->createIndex(
            '{{%idx-order_to_item-item_id}}',
            '{{%order_to_item}}',
            'item_id'
        );

        // add foreign key for table `{{%item}}`
        $this->addForeignKey(
            '{{%fk-order_to_item-item_id}}',
            '{{%order_to_item}}',
            'item_id',
            '{{%item}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-order_to_item-order_id}}',
            '{{%order_to_item}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_to_item-order_id}}',
            '{{%order_to_item}}'
        );

        // drops foreign key for table `{{%item}}`
        $this->dropForeignKey(
            '{{%fk-order_to_item-item_id}}',
            '{{%order_to_item}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            '{{%idx-order_to_item-item_id}}',
            '{{%order_to_item}}'
        );

        $this->dropTable('{{%order_to_item}}');

        $this->dropTable('{{%order}}');

        // drops foreign key for table `{{%item}}`
        $this->dropForeignKey(
            '{{%fk-item_to_type-item_id}}',
            '{{%item_to_type}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            '{{%idx-item_to_type-item_id}}',
            '{{%item_to_type}}'
        );

        // drops foreign key for table `{{%item_type}}`
        $this->dropForeignKey(
            '{{%fk-item_to_type-type_id}}',
            '{{%item_to_type}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-item_to_type-type_id}}',
            '{{%item_to_type}}'
        );

        $this->dropTable('{{%item_to_type}}');

        $this->dropTable('{{%item_type}}');

        // drops foreign key for table `{{%item}}`
        $this->dropForeignKey(
            '{{%fk-item_to_group-item_id}}',
            '{{%item_to_group}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            '{{%idx-item_to_group-item_id}}',
            '{{%item_to_group}}'
        );

        // drops foreign key for table `{{%item_group}}`
        $this->dropForeignKey(
            '{{%fk-item_to_group-group_id}}',
            '{{%item_to_group}}'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            '{{%idx-item_to_group-group_id}}',
            '{{%item_to_group}}'
        );

        $this->dropTable('{{%item_to_group}}');

        $this->dropTable('{{%item_group}}');

        $this->dropTable('{{%item}}');
    }
}
