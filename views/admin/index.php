<h1><?php echo Yii::t('BreakingNewsModule.base', 'Breaking News Configuration'); ?></h1>
<br/>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'breakingnews-edit-form',
    'enableAjaxValidation' => true,
));
?>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'id'); ?>
    <?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'id'); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'title'); ?>
    <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'title'); ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'message'); ?>
    <?php echo $form->textArea($model, 'message', array('rows' => 10, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'message'); ?>
</div>

<hr>

<?php echo CHtml::submitButton(Yii::t('NotesModule.base', 'Save'), array('class' => 'btn btn-primary')); ?>
 <a class="btn btn-default" href="<?php echo $this->createUrl('//admin/module'); ?>"><?php echo Yii::t('AdminModule.base', 'Back to modules'); ?></a>

<?php $this->endWidget(); ?>
