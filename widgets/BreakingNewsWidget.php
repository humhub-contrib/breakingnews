<?php

namespace humhub\modules\breakingnews\widgets;

/**
 * Will injected to dashboard sidebar to show a breaking news
 *
 * @package humhub.modules.breakingnews.widgets
 * @since 0.5 
 * @author Luke
 */
class BreakingNewsWidget extends \humhub\components\Widget
{

    /**
     * Executes the widgets
     */
    public function run()
    {
        return $this->render('breakingNews', array());
    }

}

?>
