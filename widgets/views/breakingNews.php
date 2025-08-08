<?php

use humhub\helpers\Html;
use yii\helpers\Url;

?>
<script <?= Html::nonce() ?>>
    $(document).ready(function () {
        humhub.modules.ui.modal.global.load("<?= Url::to(['/breakingnews/index']) ?>");
    });
</script>
