<?php

namespace tests\codeception\unit\modules\termsbox;

use Yii;
use tests\codeception\_support\HumHubDbTestCase;
use Codeception\Specify;
use humhub\modules\termsbox\models\forms\EditForm;

class TermsboxFormTest extends HumHubDbTestCase
{

    use Specify;
    
    /**
     * @inerhitdoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->module = Yii::$app->getModule('termsbox');
        Yii::$app->cache->flush();
        $this->module->settings->delete('title');
        $this->module->settings->delete('statement');
        $this->module->settings->delete('content');
        $this->module->settings->delete('active');
        $this->module->settings->delete('timestamp');
    }
    
    /**
     * Test invalid termsbox data setting
     */
    public function testValidateWithEmptyContent()
    {
       $form = new EditForm();
       $form->title = 'Test Title';
       $form->content = null;
       $form->active = true;
       $form->reset = true;
       $form->statement = 'Teststatement';
       $this->assertFalse($form->validate());
       $form->content = 'Content';
       $this->assertTrue($form->validate());
    }
    
    /**
     * Test saving the termsbox data form
     */
    public function testSaveValues()
    {
       $form = new EditForm();
       $form->title = 'MyTitle';
       $form->active = true;
       $form->reset = true;
       $form->content = 'Test Content';
       $form->statement = 'Test Statement';
       $form->save();
       
       $this->assertEquals('MyTitle', $this->module->settings->get('title'));
       $this->assertEquals('Test Content', $this->module->settings->get('content'));
       $this->assertEquals('Test Statement', $this->module->settings->get('statement'));
       $this->assertEquals(true, $this->module->settings->get('active'));
       $this->assertNotNull($this->module->settings->get('timestamp'));
    }

    /**
     * Test overwriting the termsbox data
     */
    public function testOverwriteTermsdata()
    {
       $form = new EditForm();
       $form->title = 'MyTitle';
       $form->active = true;
       $form->reset = true;
       $form->content = 'Test Message';
       $form->statement = 'Test Statement';
       $form->save();
       
       $timestamp = $this->module->settings->get('timestamp');
       
       sleep(1);
       
       $form2 = new EditForm();
       $form2->title = 'MyTitle2';
       $form2->active = true;
       $form2->reset = true;
       $form2->content = 'Test Message2';
       $form2->statement = 'Test Statement2';
       $form2->save();
       
       $module = $this->module;
       
       $this->assertEquals('MyTitle2', $module->settings->get('title'));
       $this->assertEquals('Test Message2', $module->settings->get('content'));
       $this->assertEquals('Test Statement2', $module->settings->get('statement'));
       $this->assertEquals(true, $module->settings->get('active'));
       $this->assertNotEquals($timestamp, $module->settings->get('timestamp'));
    }
    
    /**
     * Test save termsbox form without resetting the timestamp
     */
    public function testNonResetSave()
    {
       //First news
       $form = new EditForm();
       $form->title = 'MyTitle';
       $form->active = true;
       $form->reset = true;
       $form->content = 'Test Message';
       $form->statement = 'Test Statement';
       $form->save();
       
       $timestamp = $this->module->settings->get('timestamp');
       
       sleep(1);
       
       $form2 = new EditForm();
       $form2->title = 'MyTitle2';
       $form2->active = true;
       $form2->reset = false;
       $form2->content = 'Test Message2';
       $form2->statement = 'Test Statement2';
       $form2->save();
       
       $this->assertEquals('MyTitle2', $this->module->settings->get('title'));
       $this->assertEquals('Test Message2', $this->module->settings->get('content'));
       $this->assertEquals('Test Statement2', $this->module->settings->get('statement'));
       $this->assertEquals(true, $this->module->settings->get('active'));
       $this->assertEquals($timestamp, $this->module->settings->get('timestamp'));
    }
}
