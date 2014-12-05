<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 12/5/14
 * Time: 12:18 PM
 */

class Americaneagle_Visual_Block_Adminhtml_Soaplog extends Mage_Adminhtml_Block_Widget_Grid_Container {
	public function __construct() {
		parent::__construct();
		$this->_blockGroup = 'americaneagle_visual';
		$this->_controller = 'adminhtml_soaplog';
		$this->_headerText = Mage::helper('americaneagle_visual')->__('Soap Log');

		$this->removeButton('add');
	}

} 