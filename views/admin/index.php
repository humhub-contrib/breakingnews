<?php

use humhub\modules\breakingnews\models\EditForm;
use humhub\modules\content\widgets\richtext\RichTextField;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\Button;

/* @var EditForm $model */
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('BreakingnewsModule.views_admin_index', 'Breaking News Configuration') ?></div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'active')->checkbox() ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'message')->widget(RichTextField::class) ?>
        <?= $form->field($model, 'reset')->checkbox() ?>

        <hr>

        <?= Button::save()->submit() ?>
        <?= Button::defaultType(Yii::t('BreakingnewsModule.views_admin_index', 'Back to modules'))
            ->link(['/admin/module']) ?>

        <?php ActiveForm::end() ?>

    </div>
</div>