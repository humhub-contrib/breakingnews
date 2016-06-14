<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
</div>
<div class="modal-body">
    <?php echo humhub\widgets\MarkdownView::widget(array('markdown' => $message)); ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary"
            data-dismiss="modal"><?php echo Yii::t('BreakingnewsModule.views_index', 'Close'); ?></button>
</div>




