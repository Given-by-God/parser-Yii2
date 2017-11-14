<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $id_image
 * @property integer $id_links
 * @property integer $id_text
 * @property string $nameOfUrl
 *
 * @property Images $idImage
 * @property Links $idLinks
 * @property Text $idText
 */
class History extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_image', 'id_links', 'id_text', 'nameOfUrl'], 'required'],
            [['id_image', 'id_links', 'id_text'], 'integer'],
            [['nameOfUrl'], 'string'],
            [
                ['id_image'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Images::className(),
                'targetAttribute' => ['id_image' => 'id'],
            ],
            [
                ['id_links'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Links::className(),
                'targetAttribute' => ['id_links' => 'id'],
            ],
            [
                ['id_text'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Text::className(),
                'targetAttribute' => ['id_text' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_image' => 'Id Image',
            'id_links' => 'Id Links',
            'id_text' => 'Id Text',
            'nameOfUrl' => 'Name Of Url',
            'text_count' => 'asdasd',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'id_image']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdLinks()
    {
        return $this->hasOne(Links::className(), ['id' => 'id_links']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdText()
    {
        return $this->hasOne(Text::className(), ['id' => 'id_text']);
    }

    public static function InsertToHistory($url)
    {


        $sqlLinks = 'SELECT MAX(id) FROM links';
        $sqlImages = 'SELECT MAX(id) FROM images';
        $sqlText = 'SELECT MAX(id) FROM text';

        $connectionLinks = Yii::$app->db->createCommand($sqlLinks)->queryColumn();
        $connectionImages = Yii::$app->db->createCommand($sqlImages)->queryColumn();
        $connectionText = Yii::$app->db->createCommand($sqlText)->queryColumn();


        $SQL = 'INSERT INTO `history`(id_image,`id_links`,id_text,nameOfUrl)
                VALUES (:id_image,:id_links,:id_text,:nameOfUrl)';
        $command = Yii::$app->db->createCommand($SQL);
        $command->bindParam(":id_image", $connectionImages[0]);
        $command->bindParam(":id_links", $connectionLinks[0]);
        $command->bindParam(":id_text", $connectionText[0]);
        $command->bindParam(":nameOfUrl", $url);
        $command->execute();


        $query = "SELECT MAX(id) 
                    from history";
        $command = Yii::$app->db->createCommand($query);
        $command->execute();
        $max = History::find()->select('max(id)')->scalar();

        return $max;
    }

    public static function SelectFromHistory($id)
    {
        $query =
            "SELECT 
                    t1.count as 'images_count',
                    t1.src as 'src',
                    t2.count as 'links_count',
                    t2.href 'href',
                    t3.count 'text_count',
                    t3.textSearch,
                    t4.nameOfUrl 'url'
                    
	          FROM history t4
                    inner join images t1
                      on t4.id_image = t1.id
                    inner JOIN links t2
                      on t4.id_links = t2.id
                    inner JOIN text t3
                      on t4.id_text = t3.id
              WHERE t4.id = '$id'";

        $command = Yii::$app->db->createCommand($query)->queryAll();

        return $command;
    }
}
