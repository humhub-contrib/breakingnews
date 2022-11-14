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
        if (Yii::$app->user->isGuest) {
            return false;
        }

        /** @var Module $module */
        $module = Yii::$app->getModule('breakingnews');
        if (!$module->settings->get('active')) {
            return false;
        }

        // Check group restrictions
        $activeGroups = $module->settings->getSerialized('activeGroups');
        // If no group is ticked, everyone will see this breaking news
        if ($activeGroups) {
            $userGroups = array_map(static function ($group) {
                return $group->id;
            }, Yii::$app->user->identity->groups);
            // The user must be a member of at least one of the active groups
            if (!array_intersect($userGroups, $activeGroups)) {
                return false;
            }
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
