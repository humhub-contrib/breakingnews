<?php

class AdminController extends Controller {

    public $subLayout = "application.modules_core.admin.views._layout";

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex() {

        Yii::import('breakingnews.forms.*');

        $form = new BreakingNewsEditForm;
        $form->title = HSetting::Get('title', 'breakingnews');
        $form->message = HSetting::GetText('message', 'breakingnews');
        $form->active = HSetting::Get('active', 'breakingnews');

        // Ajax Check of Form
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'breakingnews-edit-form') {
            echo CActiveForm::validate($form);
            Yii::app()->end();
        }

        // Form Submitted
        if (isset($_POST['BreakingNewsEditForm'])) {
            // Allow Super Admins to inject HTML here
            //$_POST['BreakingNewsEditForm'] = Yii::app()->input->stripClean($_POST['BreakingNewsEditForm']);
            $form->attributes = $_POST['BreakingNewsEditForm'];

            if ($form->validate()) {

                HSetting::Set('title', $form->title, 'breakingnews');
                HSetting::SetText('message', $form->message, 'breakingnews');

                if ($form->active)
                    HSetting::Set('active', true, 'breakingnews');
                else
                    HSetting::Set('active', false, 'breakingnews');
                    
                if ($form->reset) {
                    foreach (UserSetting::model()->findAllByAttributes(array('name'=>'seen', 'module_id'=>'breakingnews')) as $userSetting) {
                        $userSetting->delete();
                    }
                }
                $this->redirect(Yii::app()->createUrl('breakingnews/admin/index'));
            }
        }

        $this->render('index', array('model' => $form));
    }

}

?>
