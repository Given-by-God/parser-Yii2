<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property integer $id
 * @property integer $count
 * @property string $href
 *
 * @property History[] $histories
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'href'], 'required'],
            [['count'], 'integer'],
            [['href'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Links count',
            'href' => 'Href',
        ];
    }



    public function getHistories()
    {
        return $this->hasMany(History::className(), ['id_links' => 'id']);
    }

    public static function InsertToLinks($countLinks, $strLinks)
    {

        $SQL = 'INSERT INTO `links`(`count`, `href`)
                VALUES (:countLinks,:strLinks)';
        $command = Yii::$app->db->createCommand($SQL);
        $command->bindParam(":countLinks", $countLinks);
        $command->bindParam(":strLinks", $strLinks);
        $command->execute();

        return $command;
    }
}
