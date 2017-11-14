<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "text".
 *
 * @property integer $id
 * @property integer $count
 * @property string $textSearch
 *
 * @property History[] $histories
 */
class Text extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'textSearch'], 'required'],
            [['count'], 'integer'],
            [['textSearch'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Text count',
            'textSearch' => 'Text Search',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['id_text' => 'id']);
    }

    public static function InsertToText($textCount, $textForSearching)
    {


        $SQL = 'INSERT INTO `text`(`count`, `textSearch`)
                VALUES (:textCount,:textForSearching)';
        $command = Yii::$app->db->createCommand($SQL);
        $command->bindParam(":textCount", $textCount);
        $command->bindParam(":textForSearching", $textForSearching);
        $command->execute();

        return $command;


//        $this->count = $textCount;
//        $this->textSearch = $textForSearching;
//
//        $this->insert();
//
//        return $this;
    }
}
