<?php
/**
 *
 * Package :- Robots
 * Edition :- community
 * Developed By :- CueBlocks.com
 * 
 */
class CueBlocks_Robots_Adminhtml_RobotsController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->_forward('edit');
		return $this;
	}   
	public function indexAction()
	{
		$this->_initAction();       
		$this->renderLayout();
	}
	public function editAction()
	{
		$cueattributevalueId     = $this->getRequest()->getParam('id');
		if ($cueattributevalueId == 0) 
		{
			$this->loadLayout();
			$this->_setActiveMenu('robots/items');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('robots/adminhtml_robots_edit'))
			->_addLeft($this->getLayout()->createBlock('robots/adminhtml_robots_edit_tabs'));
			$this->renderLayout();
		} 
		else 
		{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('robots')->__('File does not exist'));
			$this->_redirect('*/*/');
		}
	}
	public function newAction()
	{
		$this->_forward('edit');
	}
	public function saveAction()
	{
		
		$path = BP . DS;
		$filepath= $path.'/robots.txt';
		//chmod($filepath, 0666);
		//echo substr(sprintf('%o', fileperms($filepath)), -4);
		$folderwrite=is_writable($path); 
		$write=is_writable($filepath);

		if (file_exists($filepath)):
			if($folderwrite):
				if($write):
					$content=$this->getRequest()->getParam('content');
					$filename='robots.txt';
					$create = fopen($filename, "w");
					file_put_contents($filename, $content);
					$close = fclose($create); //closes our file
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('robots')->__('File saved successfully'));
					$this->_redirect('*/*/');
				else:
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('robots')->__('File needs writable permissions'));
					$this->_redirect('*/*/');
				endif;
			else:
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('robots')->__('Folder needs writable permissions to create robots.txt'));
				$this->_redirect('*/*/');
			endif; 
		else:
		    if($folderwrite):
				
					$content=$this->getRequest()->getParam('content');
					$filename='robots.txt';
					$create = fopen($filename, "w");
					file_put_contents($filename, $content);
					$close = fclose($create); //closes our file
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('robots')->__('File saved successfully'));
					$this->_redirect('*/*/');
				
			else:
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('robots')->__('Folder needs writable permissions to create robots.txt'));
				$this->_redirect('*/*/');
			endif; 
		endif;

		
		
		
	}
}
