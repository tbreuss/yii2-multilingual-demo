<?php

use app\models\Category;
use yii\helpers\Html;
use yeesoft\multilingual\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->languageSwitcher($model); ?>

    <?= $form->field($model, 'category_id')->dropDownList(Category::dropDownList(), ['prompt' => 'Bitte wählen']) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea() ?>

    <?= $form->field($model, 'published_at')->textInput() ?>

    <?= $form->field($model, 'is_searchable')->checkbox() ?>

    <?= $model->created_at ?>

    <?= $model->updated_at ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $this->registerJs(
    "
        var config = {
            filebrowserUploadUrl: '" .  Url::base() . "/index.php/ckeditor/file?type=file',
            filebrowserImageUploadUrl: '" .  Url::base() . "/index.php/ckeditor/image?type=image'
        };
        CKEDITOR.replace('news-content_de', config);
        CKEDITOR.replace('news-content_fr', config);    
    ",
    View::POS_READY,
    'ckeditor-handler'
); ?>
