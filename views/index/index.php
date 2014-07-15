<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
        </div>
        <div class="modal-body">
            <?php 
            
            $md = new CMarkdown;
            echo $md->transform($message);

            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary"
                    data-dismiss="modal"><?php echo Yii::t('BreakingNewsModule.views_index', 'Close'); ?></button>
        </div>

    </div>
</div>


<script type="text/javascript">

    /*
     * Modal handling by close event
     */
    $('#globalModal').on('hidden.bs.modal', function (e) {

        // Reload whole page (to see changes on it)
        //window.location.reload();

        // just close modal and reset modal content to default (shows the loader)
        $('#globalModal').html('<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><div class="loader"></div></div></div></div>');
    })
</script>
