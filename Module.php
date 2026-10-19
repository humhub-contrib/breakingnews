<?php

namespace humhub\modules\breakingnews;

use DateTime;
use humhub\libs\DateHelper;
use Yii;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{
    /**
     * @return bool
     */
    public static function showBreakingNews()
    {
        if (!Yii::$app->request->isConsoleRequest && Yii::$app->controller?->layout === '@humhub/modules/user/views/layouts/main') {
            return false;
        }

        if (!static::isAvailableForUser()) {
            return false;
        }

        /** @var Module $module */
        $module = Yii::$app->getModule('breakingnews');

        $lastSeenTS = $module->settings->user()->get('timestamp');
        $currentNewsTS = $module->settings->get('timestamp');

        return $currentNewsTS != null && $lastSeenTS != $currentNewsTS;
    }

    /**
     * Checks if the current breaking news is active, not expired and addressed to the current user
     * (regardless of whether the user has already seen it).
     *
     * @return bool
     */
    public static function isAvailableForUser(): bool
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        /** @var Module $module */
        $module = Yii::$app->getModule('breakingnews');
        if ($module === null || !$module->settings->get('active')) {
            return false;
        }

        // The expiration date is stored in the system time zone (see DbDateValidator)
        if ($expires = $module->settings->get('expiresAt')) {
            $now = new DateTime('now', DateHelper::getSystemTimeZone());
            $expires = new DateTime($expires, DateHelper::getSystemTimeZone());

            if ($expires < $now) {
                return false;
            }
        }

        // Check group restrictions
        $activeGroups = $module->settings->getSerialized('activeGroups');
        $activeGroups = is_array($activeGroups) ? array_filter($activeGroups) : [];
        // If no group is ticked, everyone will see this breaking news
        if ($activeGroups) {
            $userGroups = array_map(static fn($group) => $group->id, Yii::$app->user->identity->groups);
            // The user must be a member of at least one of the active groups
            if (!array_intersect($userGroups, $activeGroups)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @inheridoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/breakingnews/admin/index']);
    }

}
