<?php 

class MainControllerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function frontpageHome(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Connexion');
        $I->seeResponseCodeIs('200');

    }

    public function frontpageFailHome(AcceptanceTester $I)
    {
        $I->amOnPage('/blabla');
        $I->seeResponseCodeIs('404');
    }

    public function frontpageHomeLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Connexion');
        $I->click('Pas encore de compte');
        $I->seeInCurrentUrl('/home/newUserPage');
        $I->see('Inscription');
    }

    public function frontpageHomeNewUser(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Connexion');
        $I->click('Pas encore de compte');
        $I->seeInCurrentUrl('/home/newUserPage');
        $I->see('Inscription');

        $I->click('Déjà Inscrit ?');
        $I->seeInCurrentUrl('/home/loginPage');
        $I->see('Connexion');

       
    }

    public function frontpageLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/home/loginPage');
        $I->see('Connexion');
    }

    public function frontpageNewUser(AcceptanceTester $I)
    {
        $I->amOnPage('/home/newUserPage');
        $I->see('Inscription');
    }

    public function frontpageFailLogin(AcceptanceTester $I)
    {
        $I->amOnPage('/home/loginPage');
        $I->fillField('login', 'Username');
        $I->fillField('pass', 'passmaill');
        $I->click('Connexion');
        $I->see('Erreur !!!');
        $I->see('Erreur : Erreur login ou mot de passe');

    }

    public function frontpageFailNewUser(AcceptanceTester $I)
    {
        $I->amOnPage('/home/newUserPage');
        $I->fillField('login', 'Username');
        $I->fillField('mail', 'test@test.fr');
        $I->fillField('pass', 'passmail');
        $I->fillField('pass2', 'passmail');

        $I->click('Inscription');
        $I->see('Erreur !!!');
        $I->see('Erreur : Login ou Mail déjà utilisé');

    }

    public function frontpageAddNewUser(AcceptanceTester $I)
    {
        $I->amOnPage('/home/newUserPage');
        $I->fillField('login', 'Username2');
        $I->fillField('mail', 'test@test2.fr');
        $I->fillField('pass', 'passmail');
        $I->fillField('pass2', 'passmail');
/*
        $I->click('Inscription');
        $I->seeInCurrentUrl('/items/listItemPage');
        $I->see('Bienvenue Username2 sur Online Advisor !');
        $I->see('Derniers items notés :');
*/
    }

    

    
    
}
