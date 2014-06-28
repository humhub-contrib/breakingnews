<?php

Yii::app()->moduleManager->register(array(
    'id' => 'breakingnews',
    'class' => 'application.modules.breakingnews.BreakingNewsModule',
    'import' => array(
        'application.modules.breakingnews.*',
    ),
    // Events to Catch
    'events' => array(
        array('class' => 'DashboardSidebarWidget', 'event' => 'onInit', 'callback' => array('BreakingNewsModule', 'onDashboardSidebarInit')),
    ),
));
?>