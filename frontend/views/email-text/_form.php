<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\EmailText */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-text-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email_subject')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email_brief')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'text')->widget(TinyMce::className(), [
        'options' => ['rows' => 40],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', /*'media',*/ 'table', 'help', 'wordcount'
              ],
            'branding' => false,
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            'image_advtab' => true,
            'images_upload_url'=> \Yii::$app->request->baseurl.'/email-text/uploadfile',
            'file_picker_types'=>'image',
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::a( 'Cancel', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
        <span class="float-right">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </span>
    </div>

    <?php ActiveForm::end(); ?>

</div>
