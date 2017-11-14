<?php

namespace app\models;

use yii\base\Model;
use keltstr\simplehtmldom\SimpleHTMLDom;

class Main extends Model
{

    public $textForSearching;
    public $url;
    public $typeOfParsing;


    function __construct($type = 0, array $config = [])
    {
        parent::__construct($config);
        session_start();
        $_SESSION['typeOfParsing'] = $type;
    }

    public function rules()
    {
        return [
            [['url', 'textForSearching', 'typeOfParsing'], 'required'],
        ];
    }


    public static function checkUrl($url)
    {
        $headers = @get_headers($url);

        if ((substr($headers[0], 9, 3) == 200)) {
            $answer = true;
        } else {
            $answer = false;
        }

        return $answer;
    }

    public static function parser($url, $textForSearching)
    {

        $page = SimpleHTMLDom::file_get_html($url);

        //Поиск совпадающего текста
        //так как второй параметр чувствителен к регистру - переводим содержимое страницы и  искомую подстроку в верхний регистр
        $findText = substr_count(
            strtoupper($page->plaintext),
            strtoupper($textForSearching)
        );
        if ($findText) {
            $textCount = $findText;
        } else {
            $textCount = 0;
        }

        $strLinks = ''; //строка для хранения всех ссылок
        $strImg = '';   //строка для хранения всех картинок

        $countLinks = 0;
        $countImg = 0;

        //поски картинок
        foreach ($page->find('a') as $title) {
            $countLinks++;
            $strLinks .= "<a href='$title->href'>'$title->href'</a><br>";
        }

        //поиск ссылок
        foreach ($page->find('img') as $title) {
            $countImg++;
            $strImg .= "<img src='$title->src'><br>";
        }

        Links::InsertToLinks($countLinks, $strLinks); //добавляем ссылки в бд

        Images::InsertToImages($countImg, $strImg);//добавляем фотографии в бд

        Text::InsertToText($textCount, $textForSearching);//текст


        $id = History::InsertToHistory($url);

        return $id;
    }
}
