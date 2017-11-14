<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history`.
 */
class m171113_143352_create_history_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'id_image' => $this->integer()->notNull(),
            'id_links' => $this->integer()->notNull(),
            'id_text' => $this->integer()->notNull(),
            'nameOfUrl' => $this->text()->notNull(),
        ]);


        //таблица,где присутствуют внешние ключи - нужно делать в поледнюю очередь,
        //так как таблицы должны существовать,чтобы на них ссылаться

        // creates index for column `id_image`
        $this->createIndex(
            'idx-history-id_image', //название
            'history',         //таблица
            'id_image'
        );

        // add foreign key for table `images`
        $this->addForeignKey(
            'fk-history-id_image',
            'history',  //таблица которая ссылается
            'id_image', //ее же колонка.Для нее же и делали индекс чуть выше
            'images',   //таблица КУДА будет ссылаться
            'id',       //колонка таблицы КУДА будет ссылаться
            'CASCADE'  //хз что такое,в примере было так
        );



        $this->createIndex(
            'idx-history-id_links',
            'history',
            'id_links'
        );

        $this->addForeignKey(
            'fk-history-id_links',
            'history',
            'id_links',
            'links',
            'id',
            'CASCADE'
        );



        $this->createIndex(
            'idx-history-id_text',
            'history',
            'id_text'
        );


        $this->addForeignKey(
            'fk-history-id_text',
            'history',
            'id_text',
            'text',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-history-id_image',
            'history'
        );

        $this->dropIndex(
            'idx-history-id_image',
            'history'
        );

        $this->dropForeignKey(
            'fk-history-id_links',
            'history'
        );

        $this->dropIndex(
            'idx-history-id_links',
            'history'
        );

        $this->dropForeignKey(
            'fk-history-id_text',
            'history'
        );

        $this->dropIndex(
            'idx-history-id_text',
            'history'
        );

        $this->dropTable('history');

    }
}
