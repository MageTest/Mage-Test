<?php

/**
*
*/
class MageTest_Core_Model_App extends Mage_Core_Model_App
{
    /**
     * Dispatched events array
     *
     * @var array
     */
    protected $_dispatchedEvents = array();

    /**
     * Initialize application front controller
     *
     * @return Mage_Core_Model_App
     */
    protected function _initFrontController()
    {
        $this->_frontController = new MageTest_Core_Controller_Front();
        Mage::register('controller', $this->_frontController);
        Varien_Profiler::start('mage::app::init_front_controller');
        $this->_frontController->init();
        Varien_Profiler::stop('mage::app::init_front_controller');
        return $this;
    }

    /**
     * Provide a public method to allow the internal Request object
     * to be set at runtime. This can be used to inject a testing request object
     *
     * @param Zend_Controller_Request_Abstract $request
     * @return void
     * @author Alistair Stead
     **/
    public function setRequest(Zend_Controller_Request_Abstract $request)
    {
        $this->_request = $request;
    }

    /**
     * Retrieve request object
     *
     * @return Mage_Core_Controller_Request_Http
     */
    public function getRequest()
    {
        if (empty($this->_request)) {
            $this->_request = new Mage_Core_Controller_Request_Http();
        }
        return $this->_request;
    }

    /**
     * Provide a public method to allow the protected internal Response object
     * to be set at runtime. This can be used to inject a testing response object
     *
     * @param Zend_Controller_Response_Abstract $response
     * @return void
     * @author Alistair Stead
     **/
    public function setResponse(Zend_Controller_Response_Abstract $response)
    {
        $this->_response = $response;
    }

    /**
     * Retrieve response object
     *
     * @return Zend_Controller_Response_Http
     */
    public function getResponse()
    {
        if (empty($this->_response)) {
            $this->_response = new Mage_Core_Controller_Response_Http();
            $this->_response->headersSentThrowsException = Mage::$headersSentThrowsException;
            $this->_response->setHeader("Content-Type", "text/html; charset=UTF-8");
        }
        return $this->_response;
    }

    /**
     * Set the mail response object
     *
     * @param Zend_Mail $mail
     *
     * @return void
     * @author Alistair Stead
     **/
    public function setResponseEmail(Zend_Mail $mail)
    {
        $this->_mail = $mail;
    }

    /**
     * Retrieve the response mail object
     *
     * @return Zend_Mail
     * @author Alistair Stead
     **/
    public function getResponseEmail()
    {
        if (empty($this->_mail)) {
            $this->_mail = new Zend_Mail();
        }
        return $this->_mail;
    }

    /**
     * Overridden for disabling events
     * fire during fixture loading
     *
     * @see Mage_Core_Model_App::dispatchEvent()
     * @param string $eventName
     * @param array $args
     * @return MageTest_Core_Model_App
     */
    public function dispatchEvent($eventName, $args)
    {
        parent::dispatchEvent($eventName, $args);

        if (!isset($this->_dispatchedEvents[$eventName])) {
            $this->_dispatchedEvents[$eventName] = 0;
        }

        $this->_dispatchedEvents[$eventName]++;

        return $this;
    }


    /**
     * Returns number of times when the event was dispatched
     *
     * @param string $eventName
     * @return int
     */
    public function getDispatchedEventCount($eventName)
    {
        if (isset($this->_dispatchedEvents[$eventName])) {
            return $this->_dispatchedEvents[$eventName];
        }
        return 0;
    }

    /**
     * Resets dispatched events information
     *
     * @return MageTest_Core_Model_App
     */
    public function resetDispatchedEvents()
    {
        $this->_dispatchedEvents = array();
        return $this;
    }
}
