<?php
/**
 * Mage-Test
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, that is bundled with this
 * package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 *
 * http://opensource.org/licenses/MIT
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email
 * to <magetest@sessiondigital.com> so we can send you a copy immediately.
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @copyright  Copyright (c) 2012-2013 MageTest team and contributors.
 */

/**
 * MageTest_PHPUnit_Framework_Assert_Event
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_PHPUnit_Framework_Assert_Event extends PHPUnit_Framework_Assert
{
    
    /**
     * Asserts that event was dispatched at least once
     *
     * @param string|array $event
     * @param string $message
     */
    public static function assertEventDispatched($eventName)
    {
        if (is_array($eventName)) {
            foreach ($eventNames as $eventName) {
                self::assertEventDispatched($eventName);
            }
            return;
        }

        $actual = Mage::app()->getDispatchedEventCount($eventName);
        $message = sprintf('%s event was not dispatched', $eventName);
        self::assertGreaterThanOrEqual(1, $actual, $message);
    }

    /**
     * Asserts that event was not dispatched
     *
     * @param string|array $event
     * @param string $message
     */
    public static function assertEventNotDispatched($eventName)
    {
        if (is_array($eventName)) {
            foreach ($eventNames as $eventName) {
                self::assertEventNotDispatched($eventName);
            }
            return;
        }

        $actual = Mage::app()->getDispatchedEventCount($eventName);
        $message = sprintf('%s event was dispatched', $eventName);
        self::assertEquals(0, $actual, $message);
    }

    /**
     * Assert that event was dispatched exactly $times
     *
     * @param string $eventName
     * @param int
     */
    public static function assertEventDispatchedExactly($eventName, $times)
    {
        $actual = Mage::app()->getDispatchedEventCount($eventName);
        $message = sprintf(
            '%s event was dispatched only %d times, but expected to be dispatched %d times',
            $eventName, $actual, $times
        );

        self::assertEquals($times, $actual, $message);
    }
}
