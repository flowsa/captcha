<?php
/**
 * captcha plugin for Craft CMS 3.x
 *
 * Flows Captcha Plugin
 *
 * @link      www.flowsa.com
 * @copyright Copyright (c) 2021 Flow
 */

namespace flowsa\captchatests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use flowsa\captcha\Captcha;

/**
 * ExampleUnitTest
 *
 *
 * @author    Flow
 * @package   Captcha
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Captcha::class,
            Captcha::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
