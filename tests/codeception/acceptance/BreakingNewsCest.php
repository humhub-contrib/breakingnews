<?php
namespace breakingnews\acceptance;

use breakingnews\AcceptanceTester;

class BreakingNewsCest
{
    
    public function testCreateNews(AcceptanceTester $I)
    {
        $I->amAdmin();
        $I->wantToTest('the creation of news');
        $I->amGoingTo('submit a the news item');
        $I->amOnRoute(['/breakingnews/admin/index']);
        $I->expectTo('See the module configuration page');
        $I->see('Breaking News Configuration');

        $I->click('[for="editform-active"]'); // Active
        $I->fillField('EditForm[title]', 'Test title');
        $I->fillField('#editform-message .humhub-ui-richtext', 'Test message');
        $I->click('[for="editform-reset"]'); // Mark as unseen for all users
        $I->click('Save');
        $I->wait(3);
        $I->expectTo('see no errors');
        $I->dontSeeElement('.error-summary');
        
        $I->logout();
        
        $I->amGoingTo('check if the message is displayed');
        $I->amUser();
        $I->expectTo('see the breaking news modal');
        $I->wait(3);
        $I->see('Test title');
        $I->see('Test message');
        
        $I->amGoingTo('test if the message disappears after page refresh');
        $I->amOnRoute(['/']);
        $I->wait(5);
        $I->dontSee('Test title');
        $I->dontSee('Test message');
    }
   
}