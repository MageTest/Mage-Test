<?php
/**
 * MageTest_Core_Model_Config
 *
 * @uses Mage
 * @category MageTest
 * @package  MageTest
 * @copyright Copyright (c) 2013 SessionDigital. (http://www.sessiondigital.com)
 * @author Rupert Jones <rupert@sessiondigital.com>
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
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
