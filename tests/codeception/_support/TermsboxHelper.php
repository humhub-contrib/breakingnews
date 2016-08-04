<?php

namespace termsbox;

use Codeception\Module;
use Yii;
use yii\helpers\Url;

/**
 * This helper is used to populate the database with needed fixtures before any tests are run.
 * In this example, the database is populated with the demo login user, which is used in acceptance
 * and functional tests.  All fixtures will be loaded before the suite is started and unloaded after it
 * completes.
 */
class TermsboxHelper extends Module
{

    public function seeTermsbox()
    {
        $this->assertTrue(Yii::$app->getModule('termsbox')->showTermsbox());
    }
    
    public function dontSeeTermsbox()
    {
        $this->assertFalse(Yii::$app->getModule('termsbox')->showTermsbox());
    }
    
    public function acceptTermsbox()
    {
         $this->getModule('Yii2')->sendAjaxPostRequest('index-test.php?r=/termsbox/index/accept');
    }
    
    public function declineTermsbox()
    {   
         $this->getModule('Yii2')->amOnPage(['/termsbox/index/decline']);
    }
}
