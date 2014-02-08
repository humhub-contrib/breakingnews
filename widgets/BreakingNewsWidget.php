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

        $title = HSetting::Get('title', 'breakingnews');

        if ($title == "")
            return;

        $this->render('breakingNews', array(
            'breakingNewsId' => HSetting::Get('newsId', 'breakingnews'),
            'title' => $title,
        ));
    }

}

?>
