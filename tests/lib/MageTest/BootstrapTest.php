<?php

class MageTest_BootstrapTest extends PHPUnit_Framework_TestCase
{
    /**
     * Internal member variable of the bootstrap under test
     *
     * @var MageTest_Bootstrap
     **/
    protected $_bootstrap;

    /**
     * Setup fixtures and dependencies
     *
     * @return void
     **/
    public function setUp()
    {
        parent::setUp();
        // Bootstrap Mage in the same way as during testing
        $this->_bootstrap = new MageTest_Bootstrap();
    }

    /**
     * Tear down fixtures and dependencies
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->_bootstrap);
        parent::tearDown();
    }

    public function testIsValid()
    {
        $this->assertTrue($this->_bootstrap->isValid(), 'The bootstrap is unable to confirm Magento is installed');
    }

    public function testInitWillOverrideRequestAndResponse()
    {
        $this->_bootstrap->init();
        $this->assertInstanceOf(
            'MageTest_Controller_Request_HttpTestCase',
            Mage::app()->getRequest(),
            "The wrong request object is returned"
        );
        $this->assertInstanceOf(
            'MageTest_Controller_Response_HttpTestCase',
            Mage::app()->getResponse(),
            "The wrong response object is returned"
        );
    }

    public function testAppHasAdditionalMethods()
    {
        $appReflection = new ReflectionClass(Mage::app());
        $this->assertTrue($appReflection->hasMethod('setRequest'), 'app does not have setRequest method');
        $this->assertTrue($appReflection->hasMethod('setResponse'), 'app does not have setResponse method');
    }
}