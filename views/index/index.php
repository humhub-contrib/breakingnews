<?php

use humhub\modules\content\widgets\richtext\converter\RichTextToHtmlConverter;
use humhub\widgets\ModalButton;

/* @var string $title */
/* @var string $message */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
</div>
<div class="modal-body" data-ui-markdown>
    <?= RichTextToHtmlConverter::process($message) ?>
</div>
<div class="modal-footer">
    <?= ModalButton::cancel(Yii::t('BreakingnewsModule.views_index', 'Close')) ?>
</div>