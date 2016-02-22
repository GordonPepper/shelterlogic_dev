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
 * Menu Item admin widget controller
 * 
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Adminhtml_Advancedmenu_Menuitem_WidgetController extends Mage_Adminhtml_Controller_Action{
	/**
	 * Chooser Source action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function chooserAction(){
		$uniqId = $this->getRequest()->getParam('uniq_id');
		$grid = $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_widget_chooser', '', array(
			'id' => $uniqId,
		));
		$this->getResponse()->setBody($grid->toHtml());
	}
}