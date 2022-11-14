<?php

namespace humhub\modules\breakingnews;

use Yii;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    /**
     * @return bool
     */
    public static function showBreakingNews()
    {
        $module = Yii::$app->getModule('breakingnews');
        if (!$module->settings->get('active')) {
            return false;
        }

        $lastSeenTS = $module->settings->user()->get('timestamp');
        $currentNewsTS = $module->settings->get('timestamp');

        return $currentNewsTS != null && $lastSeenTS != $currentNewsTS;
    }

    /**
     * @inheridoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/breakingnews/admin/index']);
    }

}
