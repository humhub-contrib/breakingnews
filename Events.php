<?php

namespace humhub\modules\breakingnews;

use humhub\modules\breakingnews\widgets\BreakingNewsWidget;
use Yii;
use yii\base\WidgetEvent;

class Events
{
    /**
     * On Before Run of LayoutAddons, add the widget
     *
     * @param WidgetEvent $event
     */
    public static function onLayoutAddonsBeforeRun($event)
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        if (Module::showBreakingNews()) {
            // Set the new timestamp
            $module = Yii::$app->getModule('breakingnews');
            $module->settings->user()->set('timestamp', $module->settings->get('timestamp'));
            $event->sender->addWidget(BreakingNewsWidget::class, [], ['sortOrder' => 1]);
        }
    }
}
