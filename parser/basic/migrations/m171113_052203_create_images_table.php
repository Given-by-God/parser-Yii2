<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m171113_052203_create_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey()->notNull(),
            'count' =>$this->integer()->notNull(),
            'src' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('images');
    }
}
