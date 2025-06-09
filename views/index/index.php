<?php

use humhub\widgets\modal\Modal;
use humhub\widgets\modal\ModalButton;
use humhub\modules\content\widgets\richtext\converter\RichTextToHtmlConverter;

/* @var string $title */
/* @var string $message */
?>
<?= Modal::beginDialog([
    'title' => $title,
    'footer' => ModalButton::cancel(Yii::t('BreakingnewsModule.base', 'Close')),
    'dialogOptions' => ['data-ui-markdown' => true],
]) ?>
    <?= RichTextToHtmlConverter::process($message) ?>
<?= Modal::endDialog() ?>