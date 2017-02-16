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
 * Menu Group front contrller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_MenugroupController extends Mage_Core_Controller_Front_Action{
	/**
 	 * default action
 	 * @access public
 	 * @return void
 	 * @author MagPassion.com
 	 */
 	public function indexAction(){
		$this->loadLayout();
 		if (Mage::helper('advancedmenu/menugroup')->getUseBreadcrumbs()){
			if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
				$breadcrumbBlock->addCrumb('home', array(
							'label'	=> Mage::helper('advancedmenu')->__('Home'), 
							'link' 	=> Mage::getUrl(),
						)
				);
				$breadcrumbBlock->addCrumb('menugroups', array(
							'label'	=> Mage::helper('advancedmenu')->__('Menu Groups'), 
							'link'	=> '',
					)
				);
			}
		}
		$this->renderLayout();
	}
	/**
 	 * view menu group action
 	 * @access public
 	 * @return void
 	 * @author MagPassion.com
 	 */
	public function viewAction(){
		$menugroupId 	= $this->getRequest()->getParam('id', 0);
		$menugroup 	= Mage::getModel('advancedmenu/menugroup')
						->setStoreId(Mage::app()->getStore()->getId())
						->load($menugroupId);
		if (!$menugroup->getId()){
			$this->_forward('no-route');
		}
		elseif (!$menugroup->getStatus()){
			$this->_forward('no-route');
		}
		else{
			Mage::register('current_advancedmenu_menugroup', $menugroup);
			$this->loadLayout();
			if ($root = $this->getLayout()->getBlock('root')) {
				$root->addBodyClass('advancedmenu-menugroup advancedmenu-menugroup' . $menugroup->getId());
			}
			if (Mage::helper('advancedmenu/menugroup')->getUseBreadcrumbs()){
				if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')){
					$breadcrumbBlock->addCrumb('home', array(
								'label'	=> Mage::helper('advancedmenu')->__('Home'), 
								'link' 	=> Mage::getUrl(),
							)
					);
					$breadcrumbBlock->addCrumb('menugroups', array(
								'label'	=> Mage::helper('advancedmenu')->__('Menu Groups'), 
								'link'	=> Mage::helper('advancedmenu')->getMenugroupsUrl(),
						)
					);
					$breadcrumbBlock->addCrumb('menugroup', array(
								'label'	=> $menugroup->getName(), 
								'link'	=> '',
						)
					);
				}
			}
			$this->renderLayout();
		}
	}
}