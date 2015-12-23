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
 * Menu Group admin controller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Adminhtml_Advancedmenu_MenugroupController extends MagPassion_Advancedmenu_Controller_Adminhtml_Advancedmenu{
	/**
	 * init the menugroup
	 * @access protected
	 * @return MagPassion_Advancedmenu_Model_Menugroup
	 */
	protected function _initMenugroup(){
		$menugroupId  = (int) $this->getRequest()->getParam('id');
		$menugroup	= Mage::getModel('advancedmenu/menugroup');
		if ($menugroupId) {
			$menugroup->load($menugroupId);
		}
		Mage::register('current_menugroup', $menugroup);
		return $menugroup;
	}
 	/**
	 * default action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->_title(Mage::helper('advancedmenu')->__('AdvancedMenu'))
			 ->_title(Mage::helper('advancedmenu')->__('Menu Groups'));
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
	 * edit menu group - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function editAction() {
		$menugroupId	= $this->getRequest()->getParam('id');
		$menugroup  	= $this->_initMenugroup();
		if ($menugroupId && !$menugroup->getId()) {
			$this->_getSession()->addError(Mage::helper('advancedmenu')->__('This menu group no longer exists.'));
			$this->_redirect('*/*/');
			return;
		}
		$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
		if (!empty($data)) {
			$menugroup->setData($data);
		}
		Mage::register('menugroup_data', $menugroup);
		$this->loadLayout();
		$this->_title(Mage::helper('advancedmenu')->__('AdvancedMenu'))
			 ->_title(Mage::helper('advancedmenu')->__('Menu Groups'));
		if ($menugroup->getId()){
			$this->_title($menugroup->getName());
		}
		else{
			$this->_title(Mage::helper('advancedmenu')->__('Add menu group'));
		}
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) { 
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true); 
		}
		$this->renderLayout();
	}
	/**
	 * new menu group action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function newAction() {
		$this->_forward('edit');
	}
	/**
	 * save menu group - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function saveAction() {
		if ($data = $this->getRequest()->getPost('menugroup')) {
			try {
				$menugroup = $this->_initMenugroup();
				$menugroup->addData($data);
				$menugroup->save();
//				$css = $this->writeColorCss($data);
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Menu Group was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);
				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $menugroup->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} 
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
			catch (Exception $e) {
				Mage::logException($e);
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was a problem saving the menu group.'));
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Unable to find menu group to save.'));
		$this->_redirect('*/*/');
	}
	/**
	 * delete menu group - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0) {
			try {
				$menugroup = Mage::getModel('advancedmenu/menugroup');
				$menugroup->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Menu Group was successfully deleted.'));
				$this->_redirect('*/*/');
				return; 
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error deleteing menu group.'));
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				Mage::logException($e);
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Could not find menu group to delete.'));
		$this->_redirect('*/*/');
	}
	/**
	 * mass delete menu group - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function massDeleteAction() {
		$menugroupIds = $this->getRequest()->getParam('menugroup');
		if(!is_array($menugroupIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Please select menu groups to delete.'));
		}
		else {
			try {
				foreach ($menugroupIds as $menugroupId) {
					$menugroup = Mage::getModel('advancedmenu/menugroup');
					$menugroup->setId($menugroupId)->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('advancedmenu')->__('Total of %d menu groups were successfully deleted.', count($menugroupIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error deleteing menu groups.'));
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
		$menugroupIds = $this->getRequest()->getParam('menugroup');
		if(!is_array($menugroupIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('Please select menu groups.'));
		} 
		else {
			try {
				foreach ($menugroupIds as $menugroupId) {
				$menugroup = Mage::getSingleton('advancedmenu/menugroup')->load($menugroupId)
							->setStatus($this->getRequest()->getParam('status'))
							->setIsMassupdate(true)
							->save();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d menu groups were successfully updated.', count($menugroupIds)));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
			catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('advancedmenu')->__('There was an error updating menu groups.'));
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
		$fileName   = 'menugroup.csv';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menugroup_grid')->getCsv();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as MsExcel - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function exportExcelAction(){
		$fileName   = 'menugroup.xls';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menugroup_grid')->getExcelFile();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	/**
	 * export as xml - action
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function exportXmlAction(){
		$fileName   = 'menugroup.xml';
		$content	= $this->getLayout()->createBlock('advancedmenu/adminhtml_menugroup_grid')->getXml();
		$this->_prepareDownloadResponse($fileName, $content);
	}
	
	public function writeColorCss($data) {	
		try {
			if ($data['background_color']) $background_color = $data['background_color'];
			else $background_color = 'f2f2f2';
			if ($data['menu_level_top_color']) $menu_level_top_color = $data['menu_level_top_color'];
			else $menu_level_top_color = '303030';
			if ($data['menu_level_top_hover_color']) $menu_level_top_hover_color = $data['menu_level_top_hover_color'];
			else $menu_level_top_hover_color = '2882ce';
			if ($data['menu_level_top_active_color']) $menu_level_top_active_color = $data['menu_level_top_active_color'];
			else $menu_level_top_active_color = '2882ce';
			
			if ($data['submenu_background_color']) $submenu_background_color = $data['submenu_background_color'];
			else $submenu_background_color = '27A1E0';
			
			if ($data['submenu_link_color']) $submenu_link_color = $data['submenu_link_color'];
			else $submenu_link_color = 'D4F0FC';
			
			if ($data['submenu_link_hover_color']) $submenu_link_hover_color = $data['submenu_link_hover_color'];
			else $submenu_link_hover_color = 'FFFFFF';
			
			if ($data['submenu_link_hover_background_color']) $submenu_link_hover_background_color = $data['submenu_link_hover_background_color'];
			else $submenu_link_hover_background_color = $submenu_background_color;
			
			if ($data['submenu_link_active_color']) $submenu_link_active_color = $data['submenu_link_active_color'];
			else $submenu_link_active_color = 'FFFFFF';
			
			if ($data['show_submenu_border']) $show_submenu_border = $data['show_submenu_border'];
			else $show_submenu_border = 0;
			
			if ($data['submenu_border_color']) $submenu_border_color = $data['submenu_border_color'];
			else $submenu_border_color = '78C7EE';
			
			$f = Mage::getDesign()->getSkinUrl("magpassion_advancedmenu/css/color.css", array('_area'=>'frontend'));
			$f = Mage::getBaseDir('skin', array('_area'=>'frontend')) . substr($f, strpos($f, "/frontend"));
			$fh = fopen($f, 'w');
			$stringData = "";
			$stringData .= "/**\n";
			$stringData .= " * MagPassion.com extension\n";
			$stringData .= " * \n";
			$stringData .= " * @category   	MagPassion\n";
			$stringData .= " * @package		MagPassion.com\n";
			$stringData .= " * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)\n";
			$stringData .= " * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)\n";
			$stringData .= " */\n";
			$stringData .= "/**\n";
			$stringData .= " * color menu css\n";
			$stringData .= " *\n";
			$stringData .= " * @category	MagPassion\n";
			$stringData .= " * @package		MagPassion.com\n";
			$stringData .= " */\n";
			
			$stringData .= ".magpassion-nav-container { background: #".$background_color."; }\n";
			$stringData .= ".magpassion-nav-container ul.level0 li a { color:#".$menu_level_top_color."; }\n";
			$stringData .= ".magpassion-nav-container ul.level0 li a:hover, .magpassion-nav-container ul.level0 li a.over { color:#".$menu_level_top_hover_color.";}\n";
			$stringData .= ".magpassion-nav-container ul.level0 li a.active { color:#".$menu_level_top_active_color.";}\n";
			$stringData .= ".magpassion-nav-container ul li ul li { background:#".$submenu_background_color.";}\n";
			$stringData .= ".magpassion-nav-container ul li ul li a span { color: #".$submenu_link_color." !important;}\n";
			$stringData .= ".magpassion-nav-container ul li ul li a:hover { background-color: #".$submenu_link_hover_background_color.";}\n";
			$stringData .= ".magpassion-nav-container ul li ul li a:hover span { color: #".$submenu_link_hover_color." !important;}\n";
			$stringData .= ".magpassion-nav-container ul li ul li a.active span { color: #".$submenu_link_active_color." !important;}\n";
			if ($show_submenu_border && $show_submenu_border == 1) {
				$stringData .= ".magpassion-nav-container ul ul { border: thin solid #".$submenu_border_color.";}\n";
				if ($data['type'] == 'dropdown') {
					$boder_type = "border-bottom";
					$stringData .= ".magpassion-nav-container ul ul ul,.magpassion-nav-container ul ul div { top:-1px !important; }\n";
				}
				elseif ($data['type'] == 'dropline') $boder_type = "border-right";
				if ($boder_type) {
					$stringData .= ".magpassion-nav-container ul ul, .magpassion-nav-container ul ul li { ".$boder_type.": 1px solid #".$submenu_border_color.";}\n";
					$stringData .= ".magpassion-nav-container ul ul li.last { ".$boder_type.": none; }\n";
				}
			}
			
			fwrite($fh, $stringData);
			fclose($fh);
			
			return '<br/>Write css successfull!';
		}
		catch (Exception $e) {
			Mage::logException($e);
		}
		return '<br/>Can not write css. The base/default/magpassion_advancedmenu/css should be writable by webserver';
	}
}