<?php

Yii::app()->moduleManager->register(array(
    'id' => 'breakingnews',
    'class' => 'application.modules.breakingnews.BreakingNewsModule',
    'title' => Yii::t('BreakingNewsModule.base', 'BreakingNews'),
    'description' => Yii::t('ExampleModule.base', 'Show a breaking news popup on dashboard.'),
    'author' => '',
    'version' => '',
    'configRoute' => '//breakingnews/admin',
    'import' => array(
        'application.modules.breakingnews.*',
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'DashboardSidebarWidget', 'event' => 'onInit', 'callback' => array('BreakingNewsModule', 'onDashboardSidebarInit')),
    ),
));
?>