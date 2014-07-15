<?php

class BreakingNewsEditForm extends CFormModel {

    public $active;
    public $title;
    public $message;
    public $reset;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('title, message', 'required'),
            array('reset, active', 'safe')
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'active' => Yii::t('BreakingNewsModule.forms_BreakingNewsEditForm', 'Active'),
            'title' => Yii::t('BreakingNewsModule.forms_BreakingNewsEditForm', 'Title'),
            'message' => Yii::t('BreakingNewsModule.forms_BreakingNewsEditForm', 'Message'),
            'reset' => Yii::t('BreakingNewsModule.forms_BreakingNewsEditForm', 'Mark as unseen for all users'),
        );
    }

}
