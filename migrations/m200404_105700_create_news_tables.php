<?php

use yii\db\Migration;

class m200404_105700_create_news_tables extends Migration {

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(127)->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ], $tableOptions);

        $this->createTable('{{%category_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull()->defaultValue(0),
            'date' => $this->date()->notNull(),
            'is_searchable' => $this->boolean()->defaultValue(1),
            'published_at' => $this->dateTime()->null(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'deleted_at' => $this->dateTime(),
        ], $tableOptions);

        $this->createTable('{{%news_lang}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
        ], $tableOptions);

        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('fk_category_lang', '{{%category_lang}}', 'owner_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('fk_news_lang', '{{%news_lang}}', 'owner_id', '{{%news}}', 'id', 'CASCADE', 'CASCADE');
        }
    }

    public function down()
    {
        if ($this->db->driverName === 'mysql') {
            $this->dropForeignKey('fk_news_lang', '{{%news_lang}}');
            $this->dropForeignKey('fk_category_lang', '{{%category_lang}}');
        }
        $this->dropTable('{{%news_lang}}');
        $this->dropTable('{{%news}}');
        $this->dropTable('{{%category_lang}}');
        $this->dropTable('{{%category}}');
    }

}
