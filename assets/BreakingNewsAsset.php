<?php

namespace humhub\modules\breakingnews\assets;

use humhub\components\assets\AssetBundle;

class BreakingNewsAsset extends AssetBundle
{
    public $sourcePath = '@breakingnews/resources';
    public $js = [
        'js/humhub.breakingnews.js',
    ];

}
