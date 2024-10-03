<?php

namespace humhub\modules\breakingnews\assets;

use yii\web\AssetBundle;

class BreakingNewsAsset extends AssetBundle
{
    public $sourcePath = '@breakingnews/resources';
    public $css = [];
    public $js = [
        'js/humhub.breakingnews.js',
    ];

}
