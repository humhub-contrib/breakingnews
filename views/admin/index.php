<?php

use humhub\modules\breakingnews\assets\BreakingNewsAsset;
use humhub\modules\breakingnews\models\EditForm;
use humhub\modules\content\widgets\richtext\RichTextField;
use humhub\widgets\form\ActiveForm;
use humhub\modules\user\models\Group;
use humhub\widgets\bootstrap\Button;
use humhub\modules\ui\form\widgets\DatePicker;
use humhub\modules\ui\form\widgets\TimePicker;
use humhub\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use humhub\components\View;

/**
 * @var EditForm $model
 * @var View $this
 */

BreakingNewsAsset::register($this);

?>
<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('BreakingnewsModule.base', 'Breaking News Configuration') ?></div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'container']]) ?>

        <?= $form->field($model, 'active')->checkbox(['data' => ['action-change' => 'breakingnews.changeStatus']]) ?>

        <div class="row" id="expiration_row" style="<?= !$model->active ? Html::cssStyleFromArray(['display' => 'none']) : '' ?>">
            <div class="col-6" style="z-index: 10">
                <?= $form
                    ->field($model, 'expiresAt')
                    ->widget(DatePicker::class, [
                        'clientOptions' => [
                            'minDate' => new JsExpression('new Date()'),
                        ],
                    ]) ?>
            </div>
            <div class="col-6">
                <?= $form
                    ->field($model, 'expiresTime')
                    ->widget(TimePicker::class)
                    ->label("&nbsp") ?>
            </div>
        </div>

        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'message')->widget(RichTextField::class) ?>
        <?= $form->beginCollapsibleFields(Yii::t('BreakingnewsModule.base', 'Groups restriction')) ?>
        <?= $form->field($model, 'activeGroups')->checkboxList(ArrayHelper::map(Group::find()->all(), 'id', 'name')) ?>
        <?= $form->endCollapsibleFields() ?>
        <?= $form->field($model, 'reset')->checkbox() ?>

        <hr>

        <?= Button::save()->submit() ?>
        <?= Button::light(Yii::t('BreakingnewsModule.base', 'Back to modules'))
            ->link(['/admin/module']) ?>

        <?php ActiveForm::end() ?>

    </div>
</div>
