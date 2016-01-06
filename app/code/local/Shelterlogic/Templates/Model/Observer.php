<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 1/6/16
 * Time: 1:34 PM
 */



class Shelterlogic_Templates_Model_Observer
{
    public function beforeBlocksGenerate($observer) {
        if(Mage::getStoreConfigFlag('shelterlogic/update_handle_logging/logging_enabled')){
            //code from ben marks on magento stackexchange
            $req  = Mage::app()->getRequest();
            $info = sprintf(
                "\nRequest: %s\nFull Action Name: %s_%s_%s\nHandles:\n\t%s\nUpdate XML:\n%s",
                $req->getRouteName(),
                $req->getRequestedRouteName(),      //full action name 1/3
                $req->getRequestedControllerName(), //full action name 2/3
                $req->getRequestedActionName(),     //full action name 3/3
                implode("\n\t",$observer->getLayout()->getUpdate()->getHandles()),
                $observer->getLayout()->getUpdate()->asString()
            );

            // Force logging to var/log/layout.log
            Mage::log($info, Zend_Log::INFO, 'layout.log', true);
        }
    }
}