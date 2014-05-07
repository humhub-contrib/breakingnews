<script type="text/javascript">

    $(document).ready(function() {

        $('#globalModal').modal({
            remote: '<?php echo Yii::app()->createUrl('//breakingnews/index'); ?>',
            show: true
        })

    });

</script>
