<?php

use humhub\modules\breakingnews\Events;
use humhub\widgets\LayoutAddons;

/** @noinspection MissedFieldInspection */
return [
    'id' => 'breakingnews',
    'class' => humhub\modules\breakingnews\Module::class,
    'namespace' => 'humhub\modules\breakingnews',
    'events' => [
        ['class' => LayoutAddons::class, 'event' => LayoutAddons::EVENT_BEFORE_RUN, 'callback' => [Events::class, 'onLayoutAddonsBeforeRun']],
    ],
];
?>