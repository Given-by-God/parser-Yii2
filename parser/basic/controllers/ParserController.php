<?php

namespace app\controllers;

use app\models\History;
use app\models\Main;
use yii\web\Controller;
use Yii;

class ParserController extends Controller
{

    public function actionIndex()
    {
        //получение запросов от формы
        $request = Yii::$app->request->post('Main');
        $url = $request['url'];

        $textForSearching = $request['textForSearching'];
        $typeOfParsing = $request['typeOfParsing'];


        $model = new Main($typeOfParsing); //тип парсинга записывается  в сессию в конструкторе

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // //проверка на существование url
            if (Main::checkUrl($url)) {

                $id = Main::parser($url, $textForSearching); //сам парсер.Возвращает id последней добавленной "истории"

                return $this->redirect(['view', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('error', "Введите адекватный,существующий URL. В Формате http://site.com");

                return $this->render(
                    'index',
                    [
                        'model' => $model,
                    ]
                );
            }
        }


        return $this->render(
            'index',
            [
                'model' => $model,
            ]
        );
    }

    public function actionView($id)
    {

        $array = History::SelectFromHistory($id);//получаем выборку из бд в виде ассоциативного массива
        $type = $_SESSION["typeOfParsing"];


        return $this->render(
            'view',
            [
                'model' => $array,
                'type' => $type,
            ]
        );
    }
}