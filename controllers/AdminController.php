<?php

namespace humhub\modules\breakingnews\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\breakingnews\models\EditForm;
use Yii;
use yii\helpers\Url;

class AdminController extends Controller
{

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {
        $form = new EditForm();
        
        if ($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {

            return $this->redirect(Url::to(['/breakingnews/admin/index']));
        }

        return $this->render('index', ['model' => $form]);
    }

}