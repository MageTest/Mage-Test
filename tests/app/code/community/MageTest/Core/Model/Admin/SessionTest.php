<?php

class SessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Member variable that will hold session object
     *
     * @var Mage_Admin_Model_Session
     **/
    protected $_session;

    /**
     * Setup fixtures and dependencies
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setUp()
    {
        parent::setUp();
        // Bootstrap Mage in the same way as during testing
        $stub = $this->getMockForAbstractClass('MageTest_PHPUnit_Framework_ControllerTestCase');
        $stub->mageBootstrap();

        $this->_session = Mage::getSingleton('admin/session');
    }

    /**
     * Tear down fixtures and dependencies
     *
     * @return void
     * @author Alistair Stead
     **/
    public function tearDown()
    {
        parent::tearDown();
        unset(
            $this->_session
        );
        Mage::reset();
    }

    /**
     * mageAdminSessionHasBeenPatched
     * @author Alistair Stead
     * @test
     */
    public function mageAdminSessionHasBeenPatched()
    {
        $this->assertInstanceOf(
            'MageTest_Core_Model_Admin_Session',
            $this->_session,
            "The session is of the wrong class"
        );
    } // mageAdminSessionHasBeenPatched

    /**
     * sessionLoginDoesNotCallCoreHeaderFunction
     * @author Alistair Stead
     * @test
     */
    public function sessionLoginDoesNotCallCoreHeaderFunction()
    {
        // Mage_Admin_Model_Session should not call header();
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    } // sessionLoginDoesNotCallCoreHeaderFunction
}