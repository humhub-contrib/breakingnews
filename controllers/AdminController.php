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

        $form = new EditForm;
        $form->title = Setting::Get('title', 'breakingnews');
        $form->message = Setting::GetText('message', 'breakingnews');
        $form->active = Setting::Get('active', 'breakingnews');

        if ($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            return $this->redirect(Url::to(['/breakingnews/admin/index']));
        }

        return $this->render('index', ['model' => $form]);
    }

}

?>
