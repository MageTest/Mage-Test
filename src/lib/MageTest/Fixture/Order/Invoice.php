<?php
/**
 * Magento Unit Test Object factory for Order Invoice
 *
 * @category   Integration Tests
 * @package    Ibuildings_Mage_Test
 * @copyright  Copyright (c) 2010 Ibuildings
 * @version    $Id$
 */

/**
 * Ibuildings_Mage_Test_Factory_Order_Invoice
 *
 * @category   Integration Tests
 * @package    Ibuildings_Mage_Test
 * @subpackage Ibuildings_Mage_Test_Factory
 * @author Alistair Stead
 */
class MageTest_Fixture_Order_Invoice extends MageTest_Fixture
{
    /**
    * Helper funtion to constuct an invoice to be used for testing
    *
    * @return Test_Helper_Order_Invoice
    * @author Alistair Stead
    **/
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