<?php

use humhub\modules\dashboard\widgets\Sidebar;

return [
    'id' => 'breakingnews',
    'class' => 'humhub\modules\breakingnews\Module',
    'namespace' => 'humhub\modules\breakingnews',
    'events' => [
        ['class' => Sidebar::className(), 'event' => Sidebar::EVENT_INIT, 'callback' => ['humhub\modules\breakingnews\Module', 'onDashboardSidebarInit']],
    ],
];
?>