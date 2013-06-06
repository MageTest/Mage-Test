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
 * MageTest_Fixture_Customer
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Fixture_Customer extends MageTest_Fixture
{
    /**
     * Helper funtion to constuct a customer to be used for testing
     *
     * @return Mage_Customer_Customer
     */
    public static function create(array $data = array())
    {
        $_data = array(
            'prefix' => 'Mr',
            'firstname' => 'Fixture',
            'middlename' => 'C',
            'lastname' => 'User',
            'email' => 'fixture.c.user@magento.com',
            'suffix' => 'Phd',
            'dob' => '07/03/1977',
            'taxvat' => '000226677',
            'gender' => 'male'
        );

        $data = array_merge($_data, $data);

        $customer = Mage::getModel('customer/customer');
        $customer->setData($data);
        $customer->setPassword($customer->generatePassword(8));

        return $customer;
    }
}
