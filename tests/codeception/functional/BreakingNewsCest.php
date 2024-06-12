<?php

namespace breakingnews\functional;

use breakingnews\FunctionalTester;
use humhub\modules\breakingnews\Module;
use Yii;
use humhub\modules\breakingnews\models\EditForm;

class BreakingNewsCest
{

    /**
     * @var Module
     */
    var $module;

    public function _before()
    {
        $this->module = Yii::$app->getModule('breakingnews');
        Yii::$app->cache->flush();
        $this->module->settings->delete('title');
        $this->module->settings->delete('message');
        $this->module->settings->delete('active');
        $this->module->settings->delete('timestamp');
    }
    
    public function testNewsActivation(FunctionalTester $I)
    {
        $I->amUser();
        $I->wantToTest('if the news activation works as expected');
        $I->amGoingTo('save the news form without activation');
        
        $form = new EditForm();
        $form->title = 'MyTitle';
        $form->active = false;
        $form->reset = true;
        $form->message = 'Test Message';
        $form->save();
        
        $I->expect('not to see the breaking news');
        $I->dontSeeBreakingNews();
        
        $I->amGoingTo('activate the news form');
        $form->active = true;
        $form->save();
        $I->expectTo('see the breaking news');
        $I->seeBreakingNews();

        $I->amGoingTo('see not expired breaking news');
        $form->active = true;
        $form->expiresAt = (new \DateTime())->modify('+10 days')->format('Y-m-d H:i:s');
        $form->save();
        $I->expectTo('see the breaking news');
        $I->seeBreakingNews();

        $I->amGoingTo('not to see not expired breaking news');
        $form->active = true;
        $form->expiresAt = (new \DateTime())->modify('-10 days')->format('Y-m-d H:i:s');
        $form->save();
        $I->expectTo('not to see the breaking news');
        $I->dontSeeBreakingNews();
        
        $I->amGoingTo('save the breaking news form again without activation');
        $form->active = false;
        $form->save();
        $I->expect('not to see the breaking news');
        $I->dontSeeBreakingNews();
    }

}
