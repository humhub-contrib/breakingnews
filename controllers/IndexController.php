<?php

/**
 * Description of IndexController
 *
 * @author Luke
 */
class IndexController extends Controller {

    /**
     * Dashboard Welcome
     *
     * Show welcome spash screen to inform about new updates
     */
    public function actionIndex() {

        $output = $this->renderPartial('index', array(
            'title' => HSetting::Get('title', 'breakingnews'),
            'message' => HSetting::GetText('message', 'breakingnews')
        ));

        Yii::app()->clientScript->render($output);
        echo $output;
        Yii::app()->end();
    }

}

?>
