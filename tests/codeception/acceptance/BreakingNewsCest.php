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
        $I->amOnPage('index-test.php?r=breakingnews/admin/index');
        $I->expectTo('See the module configuration page');
        $I->see('Breaking News Configuration');
        
        $I->click('/html/body/div[3]/div/div[2]/div/div[2]/form/div[2]/div/label/div'); // Active
        $I->fillField('EditForm[title]', 'Test title');
        $I->fillField('EditForm[message]', 'Test message');
        $I->click('/html/body/div[3]/div/div[2]/div/div[2]/form/div[6]/div/label/div'); // Reset
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
        $I->amOnPage('index-test.php');
        $I->wait(5);
        $I->dontSee('Test title');
        $I->dontSee('Test message');
    }
   
}