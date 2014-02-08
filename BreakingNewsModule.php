<?php

class BreakingNewsModule extends CWebModule {

    /**
     * On Init of Dashboard Sidebar, add the widget
     * 
     * @param type $event
     */
    public static function onDashboardSidebarInit($event) {
        if (Yii::app()->moduleManager->isEnabled('breakingnews')) {
            $event->sender->addWidget('application.modules.breakingnews.widgets.BreakingNewsWidget', array(), array('sortOrder' => 1));
        }
    }

}
