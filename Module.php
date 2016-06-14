<?php

namespace humhub\modules\breakingnews;

use Yii;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{

    /**
     * On Init of Dashboard Sidebar, add the widget
     * 
     * @param type $event
     */
    public static function onDashboardSidebarInit($event)
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $module = Yii::$app->getModule('breakingnews');
        
        if (self::showBreakingNews()) {
            // Set the new timestamp
            $module->settings->user()->set('timestamp', $module->settings->get('timestamp'));
            $event->sender->addWidget(widgets\BreakingNewsWidget::className(), array(), array('sortOrder' => 1));
        }
    }
    
    public static function showBreakingNews()
    {
        $module = Yii::$app->getModule('breakingnews');
        if(!$module->settings->get('active')) {
            return false;
        }
        
        $lastSeenTS = $module->settings->user()->get('timestamp');
        $currentNewsTS = $module->settings->get('timestamp');
        
        return $currentNewsTS != null && $lastSeenTS != $currentNewsTS;
    }

    public function getConfigUrl()
    {
        return Url::to(['/breakingnews/admin/index']);
    }

}
