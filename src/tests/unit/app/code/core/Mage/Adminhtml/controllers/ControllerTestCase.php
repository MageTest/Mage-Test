<?php
/**
 * Magento Adminhtml Controller tests case
 *
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2010 Ibuildings
 * @version    $Id$
 */

/**
 * Mage_Adminhtml_ControllerTestCase
 *
 * @package    Mage_Adminhtml
 * @subpackage Mage_Adminhtml_Test
 *
 *
 * @uses Ibuildings_Mage_Test_PHPUnit_ControllerTestCase
 */
class Mage_Adminhtml_ControllerTestCase extends MageTest_PHPUnit_Framework_ControllerTestCase {

    /**
     * Fixture user name
     *
     * @var string
     **/
    protected $userName;

    /**
     * Fixture first name
     *
     * @var string
     **/
    protected $firstName;

    /**
     * Fixture lastName
     *
     * @var string
     **/
    protected $lastName;

    /**
     * Fixture email
     *
     * @var string
     **/
    protected $email;

    /**
     * Fixture password
     *
     * @var string
     **/
    protected $password;

    /**
     * Fixture role name
     *
     * @var string
     **/
    protected $roleName;

    /**
     * Set up the fixtures for the Adminhtml module tests
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setup()
    {
        parent::setup();
        
        // Build some fuxture values
        $this->userName = 'fixture';
        $this->firstName = 'Test';
        $this->lastName = 'User';
        $this->email = 'test.user@magetest.com';
        $this->password = '123123';
        $this->roleName = 'Fixture';
        // Generate the fixture
        $this->createAdminUserFixture();        
    }
    
    /**
     * Tear down the fixtures for the Adminhtml module tests
     *
     * @return void
     * @author Alistair Stead
     **/
    public function tearDown()
    {
        $this->deleteAdminUserFixture();
    }

    /**
     * Protected function used during testing to authenticate
     * the user ahead of any tests that require the user to be authenticated
     *
     * @param $userName String Username for the admin user
     * @param $password String Password for the supplied account
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function login($userName = null, $password = null)
    {
        if (is_null($userName)) {
            $userName = $this->userName;
        }
        if (is_null($password)) {
            $password = $this->password;
        }
        $this->request->setMethod('POST')
                              ->setPost(array(
                                  'login' => array(
                                      'username' => $userName,
                                      'password' => $password,
                                    )
                              ));

        $this->dispatch('admin/index/login');
    }

    /**
     * Protected function used during testing to clear
     * the authenticated session of the admin user
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function logout()
    {
        $this->dispatch('admin/index/logout');
    }

    /**
     * Create a user in the database to be used
     * during testing
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function createAdminUserFixture()
    {
        //create new user
        try {
            $user = Mage::getModel('admin/user')
                ->setData(array(
                    'username'  => $this->userName,
                    'firstname' => $this->firstName,
                    'lastname'  => $this->lastName,
                    'email'     => $this->email,
                    'password'  => $this->password,
                    'is_active' => 1
                ))->save();

            //create new role
            $role = Mage::getModel("admin/roles")
                    ->setName($this->roleName)
                    ->setRoleType('G')
                    ->save();

            //give "all" privileges to role
            Mage::getModel("admin/rules")
                    ->setRoleId($role->getId())
                    ->setResources(array("all"))
                    ->saveRel();

            $user->setRoleIds(array($role->getId()))
                ->setRoleUserId($user->getUserId())
                ->saveRelations();
        } catch (Exception $e) {
            echo "Unable to create fixture :: {$e->getMessage()}";
        }
        
    }

    /**
     * Delete the user from the database following
     * tests
     *
     * @return void
     * @author Alistair Stead
     **/
    protected function deleteAdminUserFixture()
    {
        if ($this->userName) {
            $users = Mage::getModel('admin/user')->getCollection();
            $users->addFieldToFilter('username', array( 'eq' => $this->userName));
            $users->load();
            foreach ( $users as $user ) {
                $user->delete();
            }
        }
        
        if ($this->roleName) {
            $roles = Mage::getModel('api/roles')->getCollection();
            $roles->addFieldToFilter('role_name', array('eq' => $this->roleName));
            $roles->load();
            foreach ( $roles as $role ) {
                $role->delete();
            }
        }
    }
}