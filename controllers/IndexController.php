<?php

namespace humhub\modules\breakingnews\controllers;

use humhub\components\access\ControllerAccess;
use humhub\components\Controller;
use humhub\modules\breakingnews\models\Setting;
use humhub\modules\breakingnews\Module;
use yii\web\NotFoundHttpException;

/**
 * Description of IndexController
 *
 * @author Luke
 */
class IndexController extends Controller
{
    /**
     * @inheritdoc
     */
    protected function getAccessRules()
    {
        return [
            [ControllerAccess::RULE_LOGGED_IN_ONLY],
        ];
    }

    /**
     * Dashboard Welcome
     *
     * Show welcome spash screen to inform about new updates
     */
    public function actionIndex()
    {
        // Only for logged in users who are addressed by the active, not expired breaking news
        if (!Module::isAvailableForUser()) {
            throw new NotFoundHttpException();
        }

        return $this->renderAjax('index', [
            'title' => Setting::get('title'),
            'message' => Setting::get('message'),
        ]);
    }

}
