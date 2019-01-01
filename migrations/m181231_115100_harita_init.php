<?php

use yii\db\Migration;

class m181231_115100_harita_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'address' => $this->string(120)->notNull(),
            'zoom' => $this->smallInteger()->notNull()->defaultValue(16),
        ], $tableOptions);

        $this->createTable('saved_address', [
            'user_id' => $this->integer()->notNull(),
            'address_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('last_address', [
            'user_id' => $this->integer()->notNull(),
            'address' => $this->string(120)->notNull(),
            'zoom' => $this->smallInteger()->notNull()->defaultValue(16),
        ], $tableOptions);

        $this->createTable('default_address', [
            'name' => $this->string(60)->notNull(),
            'address_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-saved_address-user_id',
            'saved_address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-saved_address-address_id',
            'saved_address',
            'address_id',
            'address',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-last_address-user_id',
            'last_address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-last_address-user_id',
            'last_address',
            'user_id',
            1
        );
        
        $this->addForeignKey(
            'fk-default_address-address_id',
            'default_address',
            'address_id',
            'address',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-default_address-name',
            'default_address',
            'name',
            1
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-saved_address-user_id',
            'saved_address'
        );

        $this->dropForeignKey(
            'fk-saved_address-address_id',
            'saved_address'
        );

        $this->dropForeignKey(
            'fk-last_address-user_id',
            'last_address'
        );

        $this->dropIndex(
            'idx-last_address-user_id',
            'last_address'
        );

        $this->dropForeignKey(
            'fk-default_address-address_id',
            'default_address'
        );

        $this->dropIndex(
            'idx-default_address-name',
            'default_address'
        );

        $this->dropTable('address');
        $this->dropTable('saved_address');
        $this->dropTable('last_address');
        $this->dropTable('default_address');
    }
}
