<?php

namespace humhub\modules\breakingnews;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;

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

        if (Setting::Get('active', 'breakingnews') && \humhub\modules\user\models\Setting::Get(Yii::$app->user->id, 'seen', 'breakingnews') != 1) {
            \humhub\modules\user\models\Setting::Set(Yii::$app->user->id, 'seen', true, 'breakingnews');
            $event->sender->addWidget(widgets\BreakingNewsWidget::className(), array(), array('sortOrder' => 1));
        }
    }

    public function getConfigUrl()
    {
        return Url::to(['/breakingnews/admin/index']);
    }

}
