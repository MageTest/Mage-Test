<?php
/**
* 
*/
class MageTest_Core_Controller_Front extends Mage_Core_Controller_Varien_Front
{
    /**
     * Auto-redirect to base url (without SID) if the requested url doesn't match it.
     * By default this feature is enabled in configuration.
     *
     * @param Zend_Controller_Request_Http $request
     */
    protected function _checkBaseUrl($request)
    {
        if (!Mage::isInstalled() || $request->getPost()) {
            return;
        }
        if (!Mage::getStoreConfig('web/url/redirect_to_base')) {
            return;
        }

        $adminPath = (string)Mage::getConfig()->getNode(Mage_Adminhtml_Helper_Data::XML_PATH_CUSTOM_ADMIN_PATH);
        if (!$adminPath) {
            $adminPath = (string)Mage::getConfig()
                ->getNode(Mage_Adminhtml_Helper_Data::XML_PATH_ADMINHTML_ROUTER_FRONTNAME);
        }
        if (preg_match('#^' . $adminPath . '(\/.*)?$#', ltrim($request->getPathInfo(), '/'))
            && (string)Mage::getConfig()->getNode(Mage_Adminhtml_Helper_Data::XML_PATH_USE_CUSTOM_ADMIN_URL)) {
            return;
        }

        $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB, Mage::app()->getStore()->isCurrentlySecure());

        if (!$baseUrl) {
            return;
        }

        $redirectCode = 302;
        if (Mage::getStoreConfig('web/url/redirect_to_base') == 301) {
            $redirectCode = 301;
        }

        $uri  = @parse_url($baseUrl);
        $host = isset($uri['host']) ? $uri['host'] : '';
        $path = isset($uri['path']) ? $uri['path'] : '';

        $requestUri = $request->getRequestUri() ? $request->getRequestUri() : '/';
        if ($host && $host != $request->getHttpHost() || $path && strpos($requestUri, $path) === false) {
            Mage::app()->getFrontController()->getResponse()
                ->setRedirect($baseUrl, $redirectCode)
                ->sendResponse();
            // exit;
        }
    }
}