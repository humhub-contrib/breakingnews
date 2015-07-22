<?php

use yii\helpers\Url;
?>
<script type="text/javascript">

    $(document).ready(function () {

        $('#globalModal').modal({
            remote: '<?php echo Url::to(['/breakingnews/index']); ?>',
            show: true
        })

    });

</script>
