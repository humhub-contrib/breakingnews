<?php

use humhub\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

?>
<script <?= Html::nonce() ?>>
    (function () {
        const showBreakingNews = function () {
            humhub.modules.ui.modal.global.load(<?= Json::htmlEncode(Url::to(['/breakingnews/index'])) ?>);
        };

        // Modules are initialized asynchronously, so the global modal may not exist yet on `document.ready`
        if (humhub.initialized) {
            showBreakingNews();
        } else {
            $(document).one('humhub:ready', showBreakingNews);
        }
    })();
</script>
