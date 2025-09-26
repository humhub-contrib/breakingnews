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

        if (!Yii::$app->request->isConsoleRequest && Yii::$app->controller->layout === '@humhub/modules/user/views/layouts/main') {
            return false;
        }

        /** @var Module $module */
        $module = Yii::$app->getModule('breakingnews');
        if ($module === null || !$module->settings->get('active')) {
            return false;
        }

        if ($expires = $module->settings->get('expiresAt')) {
            $now = new \DateTime('now', new \DateTimeZone('UTC'));
            $expires = new \DateTime($expires, new \DateTimeZone('UTC'));

            if ($expires < $now) {
                return false;
            }
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
