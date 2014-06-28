<?php

class BreakingNewsModule extends CWebModule {

    /**
     * On Init of Dashboard Sidebar, add the widget
     * 
     * @param type $event
     */
    public static function onDashboardSidebarInit($event) {
        if (Yii::app()->moduleManager->isEnabled('breakingnews')) {
            
            if (HSetting::Get('active', 'breakingnews') && UserSetting::Get(Yii::app()->user->id, 'seen', 'breakingnews') != 1) {
                UserSetting::Set(Yii::app()->user->id, 'seen', true, 'breakingnews');
                $event->sender->addWidget('application.modules.breakingnews.widgets.BreakingNewsWidget', array(), array('sortOrder' => 1));
            }
        }
    }

}
