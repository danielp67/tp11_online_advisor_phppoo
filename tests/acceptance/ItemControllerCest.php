<?php 

class ItemControllerCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/home/loginPage');
        $I->fillField('login', 'Username');
        $I->fillField('pass', 'passmail');
        $I->click('Connexion');

    }

    // tests

    public function frontpagelistItems(AcceptanceTester $I)
    {

        
        $I->seeInCurrentUrl('/item/listItemPage');
        $I->see('Bienvenue Username sur Online Advisor !');
        $I->see('Derniers items notés :');
        
    }

    public function frontpageItem(AcceptanceTester $I)
    {

        $I->seeInCurrentUrl('/item/listItemPage');
        $I->see('Bienvenue Username sur Online Advisor !');
        $I->see('Derniers items notés :');
        $I->click('Voir les commentaires');

        $I->seeInCurrentUrl('/item/getComments/');
        $I->see('Commentaires :');
    }
    
}
