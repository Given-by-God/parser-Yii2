<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $count
 * @property string $src
 *
 * @property History[] $histories
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'src'], 'required'],
            [['count'], 'integer'],
            [['src'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Image count',
            'src' => 'Src',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['id_image' => 'id']);
    }



    public static function InsertToImages($countImg,$strImg)
    {
        $SQL = 'INSERT INTO `images`(`count`, `src`)
                VALUES (:countImg,:strImg)';
        $command = Yii::$app->db->createCommand($SQL);
        $command->bindParam(":countImg", $countImg);
        $command->bindParam(":strImg", $strImg);
        $command->execute();
        return $command;
    }
}
