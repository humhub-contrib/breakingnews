<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('BreakingnewsModule.views_admin_index', 'Breaking News Configuration'); ?></div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model); ?>


        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?= $form->checkBox($model, 'active'); ?> <?= $model->getAttributeLabel('active'); ?>
                </label>
            </div>
        </div>
        <?= $form->field($model, 'title', ['inputOptions' =>['class' => 'form-control']]); ?>
        <?= $form->error($model, 'title'); ?>
        <div class="form-group">
             <?= $form->field($model, 'message', ['inputOptions' => ['class' => 'form-control', 'id' => 'newMessageText']])->textarea(); ?>
             <?= \humhub\widgets\MarkdownEditor::widget(array('fieldId' => 'newMessageText')); ?>
             <?= $form->error($model, 'message'); ?>
            <p class="help-block"><?= Yii::t('BreakingnewsModule.views_admin_index', 'Note: You can use markdown syntax.'); ?></p>

        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <?= $form->checkBox($model, 'reset'); ?> <?= $model->getAttributeLabel('reset'); ?>
                </label>
            </div>
        </div>

        <hr>

        <?= Html::submitButton(Yii::t('BreakingnewsModule.views_admin_index', 'Save'), array('class' => 'btn btn-primary')); ?>
        <a class="btn btn-default" href="<?php echo Url::to(['/admin/module']); ?>"><?= Yii::t('BreakingnewsModule.views_admin_index', 'Back to modules'); ?></a>

        <?php ActiveForm::end(); ?>

    </div>
</div>
