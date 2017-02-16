<?php
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Menu Group model
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Model_Menugroup extends Mage_Core_Model_Abstract{
	/**
	 * Entity code.
	 * Can be used as part of method name for entity processing
	 */
	const ENTITY= 'advancedmenu_menugroup';
	const CACHE_TAG = 'advancedmenu_menugroup';
	/**
	 * Prefix of model events names
	 * @var string
	 */
	protected $_eventPrefix = 'advancedmenu_menugroup';
	
	/**
	 * Parameter name in event
	 * @var string
	 */
	protected $_eventObject = 'menugroup';
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('advancedmenu/menugroup');
	}
	/**
	 * before save menu group
	 * @access protected
	 * @return MagPassion_Advancedmenu_Model_Menugroup
	 * @author MagPassion.com
	 */
	protected function _beforeSave(){
		parent::_beforeSave();
		$now = Mage::getSingleton('core/date')->gmtDate();
		if ($this->isObjectNew()){
			$this->setCreatedAt($now);
		}
		$this->setUpdatedAt($now);
		return $this;
	}
	/**
	 * get the url to the menu group details page
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getMenugroupUrl(){
		return Mage::getUrl('advancedmenu/menugroup/view', array('id'=>$this->getId()));
	}
	/**
	 * save menugroup relation
	 * @access public
	 * @return MagPassion_Advancedmenu_Model_Menugroup
	 * @author MagPassion.com
	 */
	protected function _afterSave() {
		return parent::_afterSave();
	}
}