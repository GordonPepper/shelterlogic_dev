<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 3/4/15
 * Time: 11:56 AM
 */

class Americaneagle_Visual_Adminhtml_VisualController
extends Mage_Adminhtml_Controller_Action {
	public function setStatusAction() {
		$this->loadLayout('empty');
		$this->renderLayout();
	}

}