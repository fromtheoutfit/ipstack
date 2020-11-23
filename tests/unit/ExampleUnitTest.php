<?php
/**
 * ipstack plugin for Craft CMS 3.x
 *
 * Simple custom wrapper around the ipstack api.
 *
 * @link      https://www.theout.fit
 * @copyright Copyright (c) 2020 The Outfit, Inc
 */

namespace fromtheoutfit\ipstacktests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use fromtheoutfit\ipstack\Ipstack;

/**
 * ExampleUnitTest
 *
 *
 * @author    The Outfit, Inc
 * @package   Ipstack
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
            Ipstack::class,
            Ipstack::$plugin
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
