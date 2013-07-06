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
 * MageTest_Core_Model_App
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Core_Model_App extends Mage_Core_Model_App
{
    /**
     * Dispatched events array
     *
     * @var array
     */
    protected $_dispatchedEvents = array();

    /**
     * Initialize application front controller
     *
     * @return Mage_Core_Model_App
     */
    protected function _initFrontController()
    {
        $this->_frontController = new MageTest_Core_Controller_Front();
        Mage::register('controller', $this->_frontController);
        Varien_Profiler::start('mage::app::init_front_controller');
        $this->_frontController->init();
        Varien_Profiler::stop('mage::app::init_front_controller');
        return $this;
    }

    /**
     * Set the mail response object
     *
     * @param Zend_Mail $mail
     *
     * @return void
     */
    public function setResponseEmail(Zend_Mail $mail)
    {
        $this->_mail = $mail;
    }

    /**
     * Retrieve the response mail object
     *
     * @return Zend_Mail
     */
    public function getResponseEmail()
    {
        if (empty($this->_mail)) {
            $this->_mail = new Zend_Mail();
        }
        return $this->_mail;
    }

    /**
     * Overridden for disabling events
     * fire during fixture loading
     *
     * @see Mage_Core_Model_App::dispatchEvent()
     * @param string $eventName
     * @param array $args
     * @return MageTest_Core_Model_App
     */
    public function dispatchEvent($eventName, $args)
    {
        parent::dispatchEvent($eventName, $args);

        if (!isset($this->_dispatchedEvents[$eventName])) {
            $this->_dispatchedEvents[$eventName] = 0;
        }

        $this->_dispatchedEvents[$eventName]++;

        return $this;
    }


    /**
     * Returns number of times when the event was dispatched
     *
     * @param string $eventName
     * @return int
     */
    public function getDispatchedEventCount($eventName)
    {
        if (isset($this->_dispatchedEvents[$eventName])) {
            return $this->_dispatchedEvents[$eventName];
        }
        return 0;
    }

    /**
     * Resets dispatched events information
     *
     * @return MageTest_Core_Model_App
     */
    public function resetDispatchedEvents()
    {
        $this->_dispatchedEvents = array();
        return $this;
    }
}
