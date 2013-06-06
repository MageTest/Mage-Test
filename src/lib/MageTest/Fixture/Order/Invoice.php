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
 * MageTest_Fixture_Order_Invoice
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Fixture_Order_Invoice extends MageTest_Fixture
{
    /**
     * Helper funtion to constuct an invoice to be used for testing
     *
     * @return Test_Helper_Order_Invoice
     */
    public static function create(array $data = array())
    {
        $_data = array(
            'first_name' => 'Fixture',
            'middle_name' => 'C',
            'last_name' => 'User',
            'email' => 'fixture.c.user@magento.com'
        );

        $data = array_merge($_data, $data);

        $invoice = Mage::getModel('sales/order_invoice');
        $invoice->setData($data);

        return $invoice;
    }
}
