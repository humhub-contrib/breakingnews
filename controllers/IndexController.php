<?php

namespace humhub\modules\breakingnews\controllers;

use humhub\components\Controller;
use humhub\models\Setting;

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
        return $this->renderAjax('index', array(
                    'title' => Setting::Get('title', 'breakingnews'),
                    'message' => Setting::GetText('message', 'breakingnews')
        ));
    }

}

?>
