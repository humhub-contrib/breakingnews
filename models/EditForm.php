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

}
