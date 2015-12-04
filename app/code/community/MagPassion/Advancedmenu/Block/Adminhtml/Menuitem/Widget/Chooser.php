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
 * Menu Item admin widget chooser
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Widget_Chooser extends Mage_Adminhtml_Block_Widget_Grid{
	/**
	 * Block construction, prepare grid params
	 * @access public
	 * @param array $arguments Object data
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct($arguments=array()){
		parent::__construct($arguments);
		$this->setDefaultSort('entity_id');
		$this->setDefaultDir('ASC');
		$this->setUseAjax(true);
		$this->setDefaultFilter(array('chooser_status' => '1'));
	}
	/**
	 * Prepare chooser element HTML
	 * @access public
	 * @param Varien_Data_Form_Element_Abstract $element Form Element
	 * @return Varien_Data_Form_Element_Abstract
	 * @author MagPassion.com
	 */
	public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element){
		$uniqId = Mage::helper('core')->uniqHash($element->getId());
		$sourceUrl = $this->getUrl('advancedmenu/adminhtml_advancedmenu_menuitem_widget/chooser', array('uniq_id' => $uniqId));
		$chooser = $this->getLayout()->createBlock('widget/adminhtml_widget_chooser')
				->setElement($element)
				->setTranslationHelper($this->getTranslationHelper())
				->setConfig($this->getConfig())
				->setFieldsetId($this->getFieldsetId())
				->setSourceUrl($sourceUrl)
				->setUniqId($uniqId);
		if ($element->getValue()) {
			$menuitem = Mage::getModel('advancedmenu/menuitem')->load($element->getValue());
			if ($menuitem->getId()) {
				$chooser->setLabel($menuitem->getTitle());
			}
		}
		$element->setData('after_element_html', $chooser->toHtml());
		return $element;
	}
	/**
	 * Grid Row JS Callback
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getRowClickCallback(){
		$chooserJsObject = $this->getId();
		$js = '
			function (grid, event) {
				var trElement = Event.findElement(event, "tr");
				var menuitemId = trElement.down("td").innerHTML.replace(/^\s+|\s+$/g,"");
				var menuitemTitle = trElement.down("td").next().innerHTML;
				'.$chooserJsObject.'.setElementValue(menuitemId);
				'.$chooserJsObject.'.setElementLabel(menuitemTitle);
				'.$chooserJsObject.'.close();
			}
		';
		return $js;
	}
	/**
	 * Prepare a static blocks collection
	 * @access protected
	 * @return MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Widget_Chooser
	 * @author MagPassion.com
	 */
	protected function _prepareCollection(){
		$collection = Mage::getModel('advancedmenu/menuitem')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	/**
	 * Prepare columns for the a grid
	 * @access protected 
	 * @return MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Widget_Chooser
	 * @author MagPassion.com
	 */
	protected function _prepareColumns(){
		$this->addColumn('chooser_id', array(
			'header'	=> Mage::helper('advancedmenu')->__('Id'),
			'align' 	=> 'right',
			'index' 	=> 'entity_id',
			'type'		=> 'number',
			'width' 	=> 50
		));
		
		$this->addColumn('chooser_title', array(
			'header'=> Mage::helper('advancedmenu')->__('Title'),
			'align' => 'left',
			'index' => 'title',
		));
		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header'=> Mage::helper('advancedmenu')->__('Store Views'),
				'index' => 'store_id',
				'type'  => 'store',
				'store_all' => true,
				'store_view'=> true,
				'sortable'  => false,
			));
		}
		$this->addColumn('chooser_status', array(
			'header'=> Mage::helper('advancedmenu')->__('Status'),
			'index' => 'status',
			'type'  => 'options',
			'options'   => array(
				0 => Mage::helper('advancedmenu')->__('Disabled'),
				1 => Mage::helper('advancedmenu')->__('Enabled')
			),
		));
		return parent::_prepareColumns();
	}
	/**
	 * get url for grid
	 * @access public
	 * @return string
	 * @author MagPassion.com
	 */
	public function getGridUrl(){
		return $this->getUrl('adminhtml/advancedmenu_menuitem_widget/chooser', array('_current' => true));
	}
	/**
	 * after collection load
	 * @access protected
	 * @return MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Widget_Chooser
	 * @author MagPassion.com
	 */
	protected function _afterLoadCollection(){
		$this->getCollection()->walk('afterLoad');
		parent::_afterLoadCollection();
	}
}