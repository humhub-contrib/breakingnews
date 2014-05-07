<?php

/**
 * Will injected to dashboard sidebar to show a breaking news
 *
 * @package humhub.modules.breakingnews.widgets
 * @since 0.5 
 * @author Luke
 */
class BreakingNewsWidget extends HWidget {

    /**
     * Executes the widgets
     */
    public function run() {
        $this->render('breakingNews', array());
    }

}

?>
