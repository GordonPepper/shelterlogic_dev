<?php
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2014 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * More Extension model
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Model_Moreextension extends Mage_Core_Model_Abstract{
	/**
	 * Entity code.
	 * Can be used as part of method name for entity processing
	 */
	const ENTITY= 'advancedmenu_moreextension';
	const CACHE_TAG = 'advancedmenu_moreextension';
	/**
	 * Prefix of model events names
	 * @var string
	 */
	protected $_eventPrefix = 'advancedmenu_moreextension';
	
	/**
	 * Parameter name in event
	 * @var string
	 */
	protected $_eventObject = 'moreextension';
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function _construct(){
		parent::_construct();
		$this->_init('advancedmenu/moreextension');
	}
	/**
	 * before save more extension
	 * @access protected
	 * @return MagPassion_Advancedmenu_Model_Moreextension
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
	 * save moreextension relation
	 * @access public
	 * @return MagPassion_Advancedmenu_Model_Moreextension
	 * @author MagPassion.com
	 */
	protected function _afterSave() {
		return parent::_afterSave();
	}
}