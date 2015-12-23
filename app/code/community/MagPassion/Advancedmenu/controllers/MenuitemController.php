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
 * Menu Item front contrller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_MenuitemController extends Mage_Core_Controller_Front_Action{
	/**
 	 * default action
 	 * @access public
 	 * @return void
 	 * @author MagPassion.com
 	 */
 	public function indexAction(){
		$this->loadLayout();
 		if (Mage::helper('advancedmenu/menuitem')->getUseBreadcrumbs()){
			if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
				$breadcrumbBlock->addCrumb('home', array(
							'label'	=> Mage::helper('advancedmenu')->__('Home'), 
							'link' 	=> Mage::getUrl(),
						)
				);
				$breadcrumbBlock->addCrumb('menuitems', array(
							'label'	=> Mage::helper('advancedmenu')->__('Menu Items'), 
							'link'	=> '',
					)
				);
			}
		}
		$this->renderLayout();
	}
	/**
 	 * view menu item action
 	 * @access public
 	 * @return void
 	 * @author MagPassion.com
 	 */
	public function viewAction(){
		$menuitemId 	= $this->getRequest()->getParam('id', 0);
		$menuitem 	= Mage::getModel('advancedmenu/menuitem')
						->setStoreId(Mage::app()->getStore()->getId())
						->load($menuitemId);
		if (!$menuitem->getId()){
			$this->_forward('no-route');
		}
		elseif (!$menuitem->getStatus()){
			$this->_forward('no-route');
		}
		else{
			Mage::register('current_advancedmenu_menuitem', $menuitem);
			$this->loadLayout();
			if ($root = $this->getLayout()->getBlock('root')) {
				$root->addBodyClass('advancedmenu-menuitem advancedmenu-menuitem' . $menuitem->getId());
			}
			if (Mage::helper('advancedmenu/menuitem')->getUseBreadcrumbs()){
				if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
					$breadcrumbBlock->addCrumb('home', array(
								'label'	=> Mage::helper('advancedmenu')->__('Home'), 
								'link' 	=> Mage::getUrl(),
							)
					);
					$breadcrumbBlock->addCrumb('menuitems', array(
								'label'	=> Mage::helper('advancedmenu')->__('Menu Items'), 
								'link'	=> Mage::helper('advancedmenu')->getMenuitemsUrl(),
						)
					);
					$breadcrumbBlock->addCrumb('menuitem', array(
								'label'	=> $menuitem->getTitle(), 
								'link'	=> '',
						)
					);
				}
			}
			$this->renderLayout();
		}
	}
}