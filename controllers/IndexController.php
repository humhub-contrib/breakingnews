<?php

namespace humhub\modules\breakingnews\controllers;

use humhub\components\Controller;
use humhub\modules\breakingnews\models\Setting;

/**
 * Description of IndexController
 *
 * @author Luke
 */
class IndexController extends Controller
{

    /**
     * Dashboard Welcome
     *
     * Show welcome spash screen to inform about new updates
     */
    public function actionIndex()
    {
        return $this->renderAjax('index', [
            'title' => Setting::get('title'),
            'message' => Setting::get('message'),
        ]);
    }

}