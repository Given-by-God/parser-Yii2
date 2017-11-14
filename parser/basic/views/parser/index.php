<?
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\Html */
/* @var $model app\models\History */
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-lg-6">
        <?= Yii::$app->session->getFlash('error'); ?>
        <?= $form = Html::beginForm(['parser/index'], 'post',['id' => 'contact-form']) ?>

        <?= $form=Html::label('Url', 'main-url', ['class' => 'control-label']) ?>
        <?= $form = Html::activeInput('text', $model, 'url',['required' => true,'class' =>'form-control']) ?>

        <?= $form=Html::label('Text for searching', 'main-textforsearching', ['class' => 'control-label']) ?>
        <?= Html::activeInput('text', $model, 'textForSearching',['required' => true,'class' =>'form-control'])?>

        <?= $form=Html::label('Type of parsing', 'main-typeofparsing', ['class' => 'control-label']) ?>
        <?= Html::activeDropDownList(
            $model,
            'typeOfParsing',
            [
                'img' => 'Картинка',
                'a' => 'Ссылка',
            ],['class' =>'form-control']
        ) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?=$form = Html::endForm(); ?>

    </div>

</div>



