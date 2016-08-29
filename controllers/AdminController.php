<?php

namespace humhub\modules\breakingnews\controllers;

use Yii;
use yii\helpers\Url;
use humhub\modules\admin\components\Controller;
use humhub\models\Setting;
use humhub\modules\breakingnews\models\EditForm;

class AdminController extends Controller
{

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {

        $form = new EditForm();
        
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $form->save();
            return $this->refresh();
        }

        return $this->render('index', ['model' => $form]);
    }

}
