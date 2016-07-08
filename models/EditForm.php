<?php

namespace humhub\modules\breakingnews\models;

use Yii;

class EditForm extends \yii\base\Model
{

    public $active;
    public $title;
    public $message;
    public $reset;

    /**
     * @inheritdocs
     */
    public function init()
    {
        $settings = Yii::$app->getModule('breakingnews')->settings;
        $this->title = $settings->get('title');
        $this->message = $settings->get('message');
        $this->active = $settings->get('active');
    }
    
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(['title', 'message'], 'required'),
            array(['reset', 'active'], 'safe')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'active' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Active'),
            'title' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Title'),
            'message' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Message'),
            'reset' => Yii::t('BreakingnewsModule.forms_BreakingNewsEditForm', 'Mark as unseen for all users'),
        );
    }
    
    /**
     * Saves the given form settings.
     */
    public function save()
    {
        $module = Yii::$app->getModule('breakingnews');
        $module->settings->set('title', $this->title);
        $module->settings->set('message', $this->message);

        if ($this->active) {
            $module->settings->set('active', true);
        } else {
            $module->settings->set('active', false);
        }
              
        $lastTimeStamp = $module->settings->get('timestamp');
        if ($this->reset || $lastTimeStamp == null) {
            $module->settings->set('timestamp', time());
        }
    }

}
