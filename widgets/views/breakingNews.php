<?php

use humhub\libs\Html;
use yii\helpers\Url;
?>
<script <?= Html::nonce() ?>>
    $(document).ready(function () {
        $('#globalModal').modal('show');
        $('#globalModal .modal-content').load('<?php echo Url::to(['/breakingnews/index']); ?>');
    });
</script>
