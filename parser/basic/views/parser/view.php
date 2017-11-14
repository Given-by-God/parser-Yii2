<?;

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\History */
/* @var $type app\models\Main*/


?>
<div class="history-view">

    <?= DetailView::widget([
        'model' => $model[0],
        'attributes' => [
            [
                'attribute' => ($type == 'a' ? 'links_count' : 'images_count'),
                'value' => ($type == 'a' ? $model[0]['links_count'] : $model[0]['images_count']),

            ],

            'text_count',
            'textSearch',
            'url',
        ],
    ]) ?>

    <?
    foreach ($model[0] as $key => $value) {
        if ($key == 'href' && $type == 'a') {
            echo $value;
        }
        if ($key == 'src' && $type == 'img') {
            echo $value;
        }
    }
echo '<br>';
    ?>
</div>
