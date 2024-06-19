<?php

namespace flowsa\captchatests\acceptance;

use Craft;
use FunctionalTester;

class ExampleFunctionalCest
{
    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testCraftEdition(FunctionalTester $I)
    {
        $I->amOnPage('?p=/');
        $I->seeResponseCodeIs(200);
    }
}
