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
 * MageTest_Util_Config
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Util_Config
{
    /**
     * Set an internal config value for Magento
     * 
     * Orginal values will be stores internally and then restored after
     * all tests have been run with resetConfig().
     *
     * @return void
     * @author Alistair Stead
     **/
    public static function set($path, $value, $scope = null)
    {
        $configCollection = Mage::getModel('core/config_data')->getCollection();
            
        $configCollection->addFieldToFilter('path', array("eq" => $path));
        if (is_string($scope)) {
            $configCollection->addFieldToFilter('scope', array("eq" => $scope));
        }
        $configCollection->load();
        
        // If existing config does not exist create it
        if (count($configCollection) == 0) {
            $configData = Mage::getModel('core/config_data');
            $configData->setPath($path);
            $configData->setValue($value);
            // Calculate scope
            $scope = ($scope)? $scope : 'default';
            $configData->setScope($scope);
            $configData->save();
            $this->_newConfigValues[] = $configData;
        } 
        foreach ($configCollection as $config) {
            $this->_originalConfigValues[] = $config;
            $config->setValue($value);
            $config->save();
        }
        unset(
            $configCollection,
            $configData
        );
    }
    
    /**
     * Remove an internal config value from Magento
     * 
     * This mimics the fucntionality of the admin when you set a yes|no option
     * to no. Orginal values will be stores internally and then restored after
     * all tests have been run with resetConfig().
     *
     * @return void
     * @author Alistair Stead
     **/
    public static function remove($path, $scope = null)
    {
        $configCollection = Mage::getModel('core/config_data')->getCollection();  
        $configCollection->addFieldToFilter('path', array("eq" => $path));
        if (is_string($scope)) {
            $configCollection->addFieldToFilter('scope', array("eq" => $scope));
        }
        $configCollection->load();  
        foreach ($configCollection as $config) {
            $this->_removedConfigValues[] = $config;
            $config->delete();
        }
        unset($configCollection);
    }
    
    /**
     * Reset the Magento config to its original values.
     *
     * @return void
     * @author Alistair Stead
     **/
    public static function reset()
    {
        $config = Mage::getModel('core/config_data');
        // Reset the original values
        foreach ($this->_originalConfigValues as $value) {
            // $config->reset();
            $config->load($value->getId());
            $config->setValue($value->getValue());
            $config->save();
        }
        // Remove the new config valuse
        foreach ($this->_newConfigValues as $value) {
            // $config->reset();
            $config->load($value->getId());
            $config->delete();
        }
        // Create the values that were removed
        foreach ($this->_removedConfigValues as $value) {
            // $config->reset();
            $config->setPath($value->getPath());
            $config->setValue($value->getValue());
            // Calculate scope
            $scope = ($value->getScope())? $value->getScope() : 'default';
            $config->setScope($scope);
            $config->save();
        }
        unset(
            $config,
            $this->_originalConfigValues,
            $this->_newConfigValues,
            $this->_removedConfigValues
        );
    }
}
