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
 * Mage_Core_Model_Config
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Core_Model_Config extends Mage_Core_Model_Config
{
    /**
     * Array of mock objects, indexed by model handle
     *
     * @var array
     */
    protected $_mockObject = array();

    /**
     * Set a mock object instance for the given model class
     *
     * @param string $modelClass
     * @param object $mockObject
     *
     * @return null
     */
    public function setModelInstanceMock($modelClass, $mockObject)
    {
        $this->_mockObject[$modelClass][] = $mockObject;
    }

    /**
     * Reset the mock stack. Only for provided model class, if supplied
     *
     * @param string $modelClass
     *
     * @return null
     */
    public function resetMockStack($modelClass = null)
    {
        if (is_null($modelClass)) {
            $this->_mockObject = array();
        } else {
            unset($this->_mockObject[$modelClass]);
        }
    }

    /**
     * Over-ride of getModelInstance that will check if a mock object has been provided.
     * Mock objects are returned in a queue, until the last object, which will always be returned thereafter.
     *
     * @param string $modelClass
     * @param array  $constructArguments
     *
     * @return object
     */
    public function getModelInstance($modelClass = '', $constructArguments = array())
    {
        if (isset($this->_mockObject[$modelClass])) {
            if (count($this->_mockObject[$modelClass]) > 1) {
                return array_shift($this->_mockObject[$modelClass]);
            } else {
                return $this->_mockObject[$modelClass][0];
            }
        }
        return parent::getModelInstance($modelClass, $constructArguments);
    }
}
