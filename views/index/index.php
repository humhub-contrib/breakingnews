<?php

use humhub\modules\content\widgets\richtext\converter\RichTextToHtmlConverter;
use humhub\widgets\modal\Modal;
use humhub\widgets\modal\ModalButton;

/* @var string $title */
/* @var string $message */
?>
<?php Modal::beginDialog([
    'title' => $title,
    'footer' => ModalButton::cancel(Yii::t('BreakingnewsModule.base', 'Close')),
    'dialogOptions' => ['data-ui-markdown' => true],
]) ?>
    <?= RichTextToHtmlConverter::process($message) ?>
<?php Modal::endDialog() ?>
