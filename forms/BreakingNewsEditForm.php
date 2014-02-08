<?php

class BreakingNewsEditForm extends CFormModel {

    public $id;
    public $title;
    public $message;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('id, title, message', 'required'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('BreakingNewsModule.base', 'Unique ID for News'),
            'title' => Yii::t('BreakingNewsModule.base', 'Title'),
            'message' => Yii::t('BreakingNewsModule.base', 'Message'),
        );
    }

}