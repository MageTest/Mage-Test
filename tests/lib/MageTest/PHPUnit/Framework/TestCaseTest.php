<?php

class MageTest_PHPUnit_Framework_TestCaseTest 
    extends MageTest_PHPUnit_Framework_TestCase
{
   public function testMocksModel()
    {
        $this->assertInstanceOf(
            'Mage_Sales_Model_Order', 
            $this->getModelMock('sales/order'));
    }

    public function testMocksResourceModel()
    {
        $this->assertInstanceOf(
            'Mage_Sales_Model_Resource_Order', 
            $this->getResourceModelMock('sales/order'));
    }

    public function testMocksHelper()
    {
        $this->assertInstanceOf(
            'Mage_Catalog_Helper_Image',
            $this->getHelperMock('catalog/image'));
    }

    public function testMocksBlock()
    {
        $this->assertInstanceOf(
            'Mage_Sales_Block_Order_View',
            $this->getBlockMock('sales/order_view'));
    }
}
