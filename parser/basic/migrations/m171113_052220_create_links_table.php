<?php

use yii\db\Migration;

/**
 * Handles the creation of table `links`.
 */
class m171113_052220_create_links_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('links', [
            'id' => $this->primaryKey(),
            'count' =>$this->integer(),
            'href' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('links');
    }
}
