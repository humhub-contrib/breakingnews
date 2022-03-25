<?php

namespace humhub\modules\breakingnews\models;

use humhub\modules\breakingnews\Module;
use humhub\modules\content\widgets\richtext\RichText;
use Yii;
use yii\base\Model;

class EditForm extends Model
{
    /**
     * @var Module $module
     */
    private $module;

    public $active;
    public $title;
    public $message;
    public $reset;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->module = Yii::$app->getModule('breakingnews');

        $this->title = $this->module->settings->get('title');
        $this->message = $this->module->settings->get('message');
        $this->active = $this->module->settings->get('active');
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'message'], 'required'],
            [['reset', 'active'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'active' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Active'),
            'title' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Title'),
            'message' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Message'),
            'reset' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Mark as unseen for all users'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'message' => Yii::t('BreakingnewsModule.views_admin_index', 'Note: You can use markdown syntax.'),
        ];
    }

    /**
     * Saves the given form settings.
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->module->settings->set('title', $this->title);
        $this->module->settings->set('message', $this->message);
        $this->module->settings->set('active', $this->active);

        $lastTimeStamp = $this->module->settings->get('timestamp');
        if ($this->reset || $lastTimeStamp == null) {
            $this->module->settings->set('timestamp', time());
        }

        if ($setting = Setting::findByName('message')) {
            RichText::postProcess($this->message, $setting);
        }

        return true;
    }

}