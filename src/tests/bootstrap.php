<?php
// Define path to application directory
for ($i = 0, $d = '../'; ! file_exists($d.'app/Mage.php') && $i++ < 10; $d .= '../');

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath($d.'/app'));

require_once APPLICATION_PATH.'/Mage.php';
// Update setting so for correct behaviour under test
$_SERVER['SCRIPT_NAME'] = 'index.php';
$_SERVER['SCRIPT_FILENAME'] = 'index.php';
$_SESSION = array();
session_id(uniqid());

// Global scope param to identfy that the application is under test
$_SERVER['MAGE_TEST'] = true;
// Standard Magento configuration
$_SERVER['MAGE_IS_DEVELOPER_MODE'] = true;

// Initialize Mage_Log in case of an exception during autoloading a class
Zend_Log::INFO;