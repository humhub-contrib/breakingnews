<?php

use yii\helpers\Url;
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#globalModal').modal('show');
        $('#globalModal .modal-content').load('<?php echo Url::to(['/breakingnews/index']); ?>');
    });
</script>
