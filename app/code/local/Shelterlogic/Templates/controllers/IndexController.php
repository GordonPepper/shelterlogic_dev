<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 2/5/16
 * Time: 1:09 PM
 */

class Shelterlogic_Templates_IndexController extends Mage_Core_Controller_Front_Action {
    public function indexAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}