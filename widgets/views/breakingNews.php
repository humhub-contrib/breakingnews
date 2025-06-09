<?php

use humhub\helpers\Html;
use yii\helpers\Url;
?>
<script <?= Html::nonce() ?>>
    $(document).ready(function () {
        var modal = humhub.require('humhub.modules.ui.modal');
        modal.global.load('<?php echo Url::to(['/breakingnews/index']); ?>');
    });
</script>