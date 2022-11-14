<?php

use humhub\modules\breakingnews\models\EditForm;
use humhub\modules\content\widgets\richtext\RichTextField;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\modules\user\models\Group;
use humhub\widgets\Button;
use yii\helpers\ArrayHelper;

/* @var EditForm $model */
?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('BreakingnewsModule.views_admin_index', 'Breaking News Configuration') ?></div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'active')->checkbox() ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'message')->widget(RichTextField::class) ?>
        <?= $form->beginCollapsibleFields(Yii::t('BreakingnewsModule.views_admin_index', 'Groups restriction')) ?>
        <?= $form->field($model, 'activeGroups')->checkboxList(ArrayHelper::map(Group::find()->all(), 'id', 'name')) ?>
        <?= $form->endCollapsibleFields() ?>
        <?= $form->field($model, 'reset')->checkbox() ?>

        <hr>

        <?= Button::save()->submit() ?>
        <?= Button::defaultType(Yii::t('BreakingnewsModule.views_admin_index', 'Back to modules'))
            ->link(['/admin/module']) ?>

        <?php ActiveForm::end() ?>

    </div>
</div>