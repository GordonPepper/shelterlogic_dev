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
 * More Extension admin block
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Moreextension extends Mage_Adminhtml_Block_Widget_Grid_Container{
	/**
	 * constructor
	 * @access public
	 * @return void
	 * @author MagPassion.com
	 */
	public function __construct(){
		$this->_controller 		= 'adminhtml_moreextension';
		$this->_blockGroup 		= 'advancedmenu';
		parent::__construct();
	}
    
    protected function _toHtml()
    {
        $html = '';
        try {
            $html = file_get_contents('http://www.magpassion.com/magento.html');;
        }
        catch (Exception $e) {}
        if (!$html) $html = '<h3>Magento extensions by MagPassion</h3><p>Please visit <a href="http://www.magpassion.com/magento-extensions.html" title="magento extensions">our extensions</a>';
        return $html;
    }
}