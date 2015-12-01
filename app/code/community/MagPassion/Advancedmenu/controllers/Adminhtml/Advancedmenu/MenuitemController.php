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
 * Menu Item admin controller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Adminhtml_Advancedmenu_MenuitemController extends MagPassion_Advancedmenu_Controller_Adminhtml_Advancedmenu{
	/**
	 * init the menuitem
	 * @access protected
	 * @return MagPassion_Advancedmenu_Model_Menuitem
	 */
	protected function _initMenuitem(){
		$menuitemId  = (int) $this->getRequest()->getParam('id');
		$menuitem	= Mage::getModel('advancedmenu/menuitem');
		if ($menuitemId) {
			$menuitem->load($menuitemId);
		}
		Mage::register('current_menuitem', $menuitem);
		return $menuitem;
	}
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('advancedmenu')->__('Advancedmenu'))
			 ->_title(Mage::helper('advancedmenu')->__('Menu Items'));
		$this->renderLayout();
	}
	/**
	 * grid action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function gridAction() {
		$this->loadLayout()->renderLayout();
	}
	/**
	 * edit menu item - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function editAction() {
		$menuitemId	= $this->getRequest()->getParam('id');
		$menuitem  	= $this->_initMenuitem();
		if ($menuitemId && !$menuitem->getId()) {
			$this->_getSession()->addError(Mage::helper('advancedmenu')->__('This menu item no longer exists.'));
			$this->_redirect('*/*/');
			return;
		}
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$menuitem->setData($data);
		}
		Mage::register('menuitem_data', $menuitem);
		$this->loadLayout();
		$this->_title(Mage::helper('advancedmenu')->__('Advancedmenu'))
			 ->_title(Mage::helper('advancedmenu')->__('Menu Items'));
		if ($menuitem->getId()){
			$this->_title($menuitem->getTitle());
		}
		else{
			$this->_title(Mage::helper('advancedmenu')->__('Add menu item'));
		}
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) { 
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true); 
		}
		$this->renderLayout();
	}
	/**
	 * new menu item action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function newAction() {
		$this->_forward('edit');
	}
	/**
	 * save menu item - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost('menuitem')) {
			try {
				$menuitem = $this->_initMenuitem();
				$menuitem->addData($data);
				$image_iconName = $this->_uploadAndGetName('image_icon', Mage::helper('advancedmenu/menuitem_image')->getImageBaseDir(), $data);
				$menuitem->setData('image_icon', $image_iconName);
                if (!empty($data["block"])) {
                    $menuitem->setData('block', implode(",", $data["block"]));
                }
				if ($data["type"] == 'custom') {
					$menuitem->setData('category_id', '');
					$menuitem->setData('category', '');
				}
				elseif ($data["type"] == 'category') {
					$menuitem->setData('url', '');
				}
				$menuitem->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Menu Item was successfully saved').' '.$data['rel'].'finish');
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $menuitem->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} 
			catch (Mage_Core_Exception $e){
				if (isset($data['image_icon']['value'])){
					$data['image_icon'] = $data['image_icon']['value'];
				}
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
			catch (Exception $e) {
				Mage::logException($e);
				if (isset($data['image_icon']['value'])){
					$data['image_icon'] = $data['image_icon']['value'];
				}
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was a problem saving the menu item.'));
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Unable to find menu item to save.'));
		$this->_redirect('*/*/');
	}
	/**
	 * delete menu item - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$menuitem = Mage::getModel('advancedmenu/menuitem');
				$menuitem->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Menu Item was successfully deleted.'));
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error deleteing menu item.'));
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Could not find menu item to delete.'));
		$this->_redirect('*/*/');
	}
	/**
	 * mass delete menu item - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function massDeleteAction() {
		$menuitemIds = $this->getRequest()->getParam('menuitem');
		if(!is_array($menuitemIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Please select menu items to delete.'));
		}
		else {
			try {
				foreach ($menuitemIds as $menuitemId) {
					$menuitem = Mage::getModel('advancedmenu/menuitem');
					$menuitem->setId($menuitemId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Total of %d menu items were successfully deleted.', count($menuitemIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error deleteing menu items.'));
				Mage::logException($e);
			}
		}
		$this->_redirect('*/*/index');
	}
	/**
	 * mass status change - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function massStatusAction(){
		$menuitemIds = $this->getRequest()->getParam('menuitem');
		if(!is_array($menuitemIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Please select menu items.'));
		} 
		else {
			try {
				foreach ($menuitemIds as $menuitemId) {
				$menuitem = Mage::getSingleton('advancedmenu/menuitem')->load($menuitemId)
							->setStatus($this->getRequest()->getParam('status'))
							->setIsMassupdate(true)
							->save();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d menu items were successfully updated.', count($menuitemIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error updating menu items.'));
				Mage::logException($e);
			}
		}
		$this->_redirect('*/*/index');
	}
	/**
	 * mass menu group change - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function massMenugroupIdAction(){
		$menuitemIds = $this->getRequest()->getParam('menuitem');
		if(!is_array($menuitemIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Please select menu items.'));
		} 
		else {
			try {
				foreach ($menuitemIds as $menuitemId) {
				$menuitem = Mage::getSingleton('advancedmenu/menuitem')->load($menuitemId)
							->setMenugroupId($this->getRequest()->getParam('flag_menugroup_id'))
							->setIsMassupdate(true)
							->save();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d menu items were successfully updated.', count($menuitemIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error updating menu items.'));
				Mage::logException($e);
			}
		}
		$this->_redirect('*/*/index');
	}
	/**
	 * export as csv - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function exportCsvAction(){
		$fileName   = 'menuitem.csv';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as MsExcel - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function exportExcelAction(){
		$fileName   = 'menuitem.xls';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as xml - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function exportXmlAction(){
		$fileName   = 'menuitem.xml';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menuitem_grid')->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
}