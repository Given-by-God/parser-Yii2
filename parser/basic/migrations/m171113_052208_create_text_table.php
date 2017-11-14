<?php

use yii\db\Migration;

/**
 * Handles the creation of table `text`.
 */
class m171113_052208_create_text_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('text', [
            'id' => $this->primaryKey(),
            'count' =>$this->integer(),
            'textSearch' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('text');
    }
}
