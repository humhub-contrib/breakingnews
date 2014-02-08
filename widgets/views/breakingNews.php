<script type="text/javascript">

    $(document).ready(function() {

        // if cookie doesn't exist or not the current 
        if ($.cookie('breakingnews_seen_id') == undefined || $.cookie('breakingnews_seen_id') != "<?php echo $breakingNewsId; ?>") {

            // create cookie for current message
            $.cookie('breakingnews_seen_id', '<?php echo $breakingNewsId; ?>', { expires: 365 });


            $('#globalModal').modal({
                remote: '<?php echo Yii::app()->createUrl('//breakingnews/index'); ?>',
                show: true
            })

        }
    });

</script>
