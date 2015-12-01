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
 * Menu Group view block
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Menugroup_View extends Mage_Core_Block_Template{
	/**
	 * get the current menu group
	 * @access public
	 * @return mixed (MagPassion_Advancedmenu_Model_Menugroup|null)
	 * @author MagPassion.com
	 */
	public $menuId = 0;
	public $currentUrl = '';
	public $show_menu_top_icon = 0;
	public $show_submenu_icon = 0;
	public $show_menu_top_des = 0;
	public $show_submenu_des = 0;
	public $categorySuffix = '';
	
	
	protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($head = $this->getLayout()->getBlock('head')) {
            if (Mage::helper('advancedmenu/menugroup')->getUseLoadJquery()) {
                $head->addJs('magpassion/advancedmenu/jquery.min.js');
                $head->addJs('magpassion/advancedmenu/jquery.noconflict.js');
            }
        }
    }
    
    
	/**
	 * get the current menu group
	 * @access public
	 * @return mixed (MagPassion.com_Model_Menugroup|null)
	 * @author MagPassion.com
	 */
	public function getCurrentMenugroup(){
		return Mage::registry('current_advancedmenu_menugroup');
	}
	
	/**
	 * set the id of menu group
	 * @access public
	 * @author MagPassion.com
	 */
	public function setMenuId($id){
		$this->menuId = $id;
		return;
	}
	
	/**
	 * get the current menu group
	 * @access public
	 * @return this menu group
	 * @author MagPassion.com
	 */
	public function getMenuGroup() {
		if ($this->menuId) {
			$menugroup = Mage::getModel('advancedmenu/menugroup')
				->setStoreId(Mage::app()->getStore()->getId())
				->load($this->menuId);
			return $menugroup;
		}
	}
	
	/**
	 * init menu group
	 * @access public
	 * @author MagPassion.com
	 */
	public function initMenuGroup() {
		$menugroup = Mage::getModel('advancedmenu/menugroup')
				->setStoreId(Mage::app()->getStore()->getId())
				->load($this->menuId);
		
		$this->show_menu_top_icon = $menugroup->getShow_menu_top_icon();
		$this->show_submenu_icon = $menugroup->getShow_submenu_icon();
		$this->show_menu_top_des = $menugroup->getShow_menu_top_des();
		$this->show_submenu_des = $menugroup->getShow_submenu_des();
		$this->categorySuffix = Mage::helper('catalog/category')->getCategoryUrlSuffix();
	}
	
	/**
	 * check menu has child
	 * @access public
	 * @return true/false
	 * @author MagPassion.com
	 */
	public function hasChildMenuItems($current_id = 0) {
		$count = Mage::getResourceModel('advancedmenu/menuitem_collection')
			->addStoreFilter(Mage::app()->getStore())
			->addFilter('status', 1)
			->addFilter('menugroup_id', $this->menuId)
			->addFilter('menu_parent_id', $current_id)
			->count();
		return ($count > 0);
	}
	
	/**
	 * get the menu items
	 * @access public
	 * @return list menu items
	 * @author MagPassion.com
	 */
	public function getMenuItems($parent_id = 0) {
		$menuitems = Mage::getResourceModel('advancedmenu/menuitem_collection')
			->addStoreFilter(Mage::app()->getStore())
			->addFilter('status', 1)
			->addFilter('menugroup_id', $this->menuId)
			->addFilter('menu_parent_id', $parent_id)
			->setOrder('menuorder', 'asc')
			->load();
		return $menuitems;
	}
	
	/**
	 * get block title
	 * @access public
	 * @return title
	 * @author MagPassion.com
	 */
	public function getBlockTitle($blockId) {
		$title = Mage::getModel('cms/block')->load($blockId)->getTitle();
		return $title;
	}
	
	/**
	 * get category link from id
	 * @access public
	 * @return absolute link
	 * @author MagPassion.com
	 */
	public function getCategoryLink($cat_id) {
		return Mage::getModel('catalog/category')->load($cat_id)->getUrl();
	}
	
	/**
	 * check active link
	 * @access public
	 * @return true/false
	 * @author MagPassion.com
	 */
	public function isLinkActive($link) {
		if ($this->currentUrl == $this->getBaseUrl()) {
			if ($link == $this->getBaseUrl()) return true;
			return false;
		}
		elseif ($link == $this->getBaseUrl()) return false;
		if (strpos($this->currentUrl, $link) === false) return false;
		else return true;
	}
	
	/**
	 * get menu html element
	 * @access public
	 * @return list menu html element
	 * @author MagPassion.com
	 */
	public function getMenuHtmlElements($parent_id = 0, $level, $class = '', $content_type, $blockIds) {
		$html = '';
		$count = 0;
		$items = null;
		$arrBlockIds = array();
		if ($content_type != 'block')
			$items = $this->getMenuItems($parent_id);
		if ($content_type == 'child')
			$blockIds = null;
		else {
			$arrBlockIds = explode(",", $blockIds);
		}
		$totalItems = count($items) + count($arrBlockIds);
		if ($totalItems > 0) {
			
			$html .= '<ul class="magpassion-advancedmenu '.$class.' level'.$level.'"';
			if ($level == 0) $html .= ' id="'.$class.'"';
			$html .= '>';
			
			foreach ($items as $item) {
				$html .= '<li class="'.$item->getClass();
				if ($count+1== $totalItems) $html .= ' last';
				else if ($count == 0) $html .= ' first';
				$html .= '">';
				if ($item->getType() == 'category') {
					$link = $this->getCategoryLink($item->getCategory_id());
					$linkNoSuffix = str_replace($this->categorySuffix,"", $link);
					$class = $item->getClass();
					if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
					if ($this->isLinkActive($linkNoSuffix)) $class .= ' active';
					if ($class) $class = ' class="'.$class.'" ';
					$rel = '';
					if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
					$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
					
					$html .= '<span class="mp-menu';
					if ((($level == 0 && $this->show_menu_top_icon == 1) || ($level > 0 && $this->show_submenu_icon == 1)) && $item->getImage_icon()) {
						$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
					}
					else $html .= '">';
					$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
					if ((($level == 0 && $this->show_menu_top_des == 1) || ($level > 0 && $this->show_submenu_des == 1)) && $item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
					$html .= '</span>';
					$html .= '</a>';
				}
				elseif ($item->getType() == 'custom') {
					if (strpos($item->getUrl(), 'http:') !== false) $link = $item->getUrl();
					else 
						$link = $this->getBaseUrl().$item->getUrl();
					$class = $item->getClass();
					if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
					if ($this->isLinkActive($link)) $class .= ' active';
					if ($class) $class = ' class="'.$class.'" ';
					$rel = '';
					if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
					$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
					$html .= '<span class="mp-menu';
					if ((($level == 0 && $this->show_menu_top_icon == 1) || ($level > 0 && $this->show_submenu_icon == 1)) && $item->getImage_icon()) {
						$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
					}
					else $html .= '">';
					$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
					if ((($level == 0 && $this->show_menu_top_des == 1) || ($level > 0 && $this->show_submenu_des == 1)) && $item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
					$html .= '</span>';
					$html .= '</a>';
				}
				else {
	                // Hide link
	            }
				$html .= $this->getMenuHtmlElements($item->getId(), $level + 1, '', $item->getSubmenu_content(), $item->getBlock()); 
				$html .= '</li>';
				
				$count++;
			}
				
			foreach ($arrBlockIds as $blockId) {
				$title = $this->getBlockTitle($blockId);
				if ($title) {
					$html .= '<li';
					if ($count+1== $totalItems) $html .= ' class="last"';
					else if ($count == 0) $html .= ' class="first"';
					$html .= '>';
					
					$html .= '<a href="#" title="'.$title.'"';
					$html .= ' class="level'.$level.'"';
					$html .= '>';
					$html .= '<span class="mp-menu';
					$html .= '">';
					$html .= '<span class="mp-menu-title">'.$title.'</span>';
					//$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
					$html .= '</span>';
					$html .= '</a>';
				
					$html .= '</li>';
				}
				$count++;
			}
			$html .= '</ul>';
		}
		
		return $html;
	}
	
	/**
	 * get menu html element for mega style
	 * @access public
	 * @return list menu html element
	 * @author MagPassion.com
	 */
	public function getMenuMegaLevelTwo($parent_id = 0, $level, $content_type, $blockIds) {
		$html = '';
		$items = null;
		$arrBlockIds = array();
		if ($content_type != 'block')
			$items = $this->getMenuItems($parent_id);
		if ($content_type == 'child')
			$blockIds = null;
		else {
			$arrBlockIds = explode(",", $blockIds);
		}
		$totalItems = count($items) + count($arrBlockIds);
		
		if ($totalItems > 0) {
			if ($level == 2) $html .= '<ul class="childmenu level'.$level.'">';
		}
		$count = 0;
		foreach ($items as $item) {
			$html .= '<li';
			if ($level > 2) $html .= ' class="li-child'.$level.'"';
			$html .= '>';
			
			if ($item->getType() == 'category') {
				$link = $this->getCategoryLink($item->getCategory_id());
				$linkNoSuffix = str_replace($this->categorySuffix,"", $link);
				$class = $item->getClass();
				if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
				if ($this->isLinkActive($linkNoSuffix)) $class .= ' active';
				if ($class) $class = ' class="'.$class.'" ';
				$rel = '';
				if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
				$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
				
				$html .= '<span class="mp-menu';
				if ($item->getImage_icon()) {
					$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
				}
				else $html .= '">';
				$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
				if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
				$html .= '</span>';
				$html .= '</a>';
			}
			elseif ($item->getType() == 'custom') {
				if (strpos($item->getUrl(), 'http:') !== false) $link = $item->getUrl();
				else 
					$link = $this->getBaseUrl().$item->getUrl();
				$class = $item->getClass();
				if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
				if ($this->isLinkActive($link)) $class .= ' active';
				if ($class) $class = ' class="'.$class.'" ';
				$rel = '';
				if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
				$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
				
				$html .= '<span class="mp-menu';
				if ($item->getImage_icon()) {
					$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
				}
				else $html .= '">';
				$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
				if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
				$html .= '</span>';
				$html .= '</a>';
			}
			else {
                // Hide link
            }
			$html .= $this->getMenuMegaLevelTwo( $item->getId(), $level + 1, $item->getSubmenu_content(), $item->getBlock() ); 
			$html .= '</li>';
			$count++;
		}
		
		foreach ($arrBlockIds as $blockId) {
			$title = $this->getBlockTitle($blockId);
			if ($title) {
				$html .= '<div class="magpassion-child-content';
				if ($count + 1 == $totalItems) $html .= ' last';
				$html .= '">';
				
				$html .= '<a href="#" title="'.$title.'"';
				$html .= ' class="level'.$level.'"';
				$html .= '>';
				$html .= '<span class="mp-menu';
				$html .= '">';
				$html .= '<span class="mp-menu-title">'.$title.'</span>';
				$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
				$html .= '</span>';
				$html .= '</a>';
			
				$html .= '</div>';
				
				$count++;
			}
		}
		
		
		if ($totalItems > 0) {
			if ($level == 2) $html .= '</ul>';
		}
		
		return $html;
	}
	
	/**
	 * get menu html element for mega style
	 * @access public
	 * @return list menu html element
	 * @author MagPassion.com
	 */
	public function getMenuMegaLevelOne($parent_id = 0, $level, $content_type, $blockIds) {
		$html = '';
		$items = null;
		$arrBlockIds = array();
		if ($content_type != 'block')
			$items = $this->getMenuItems($parent_id);
		if ($content_type == 'child')
			$blockIds = null;
		else {
			$arrBlockIds = explode(",", $blockIds);
		}
		$totalItems = count($items) + count($arrBlockIds);
		
		if ($totalItems > 0) {
			$width = $totalItems * 201;
			$html .= '<ul class="level1"><li style="float:left; width:'.$width.'px">';
		}
		$count = 0;
		foreach ($items as $item) {
			$html .= '<div class="magpassion-child-content';
			if ($count + 1 == $totalItems) $html .= ' last';
			$html .= '">';
			//$html .= '<li'.$class.'>';
			
			if ($item->getType() == 'category') {
				$link = $this->getCategoryLink($item->getCategory_id());
				$linkNoSuffix = str_replace($this->categorySuffix,"", $link);
				$class = $item->getClass().' level1';
				if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
				if ($this->isLinkActive($linkNoSuffix)) $class .= ' active';
				if ($class) $class = ' class="'.$class.'" ';
				$rel = '';
				if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
				$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
				
				$html .= '<span class="mp-menu';
				if ($item->getImage_icon()) {
					$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
				}
				else $html .= '">';
				$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
				if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
				$html .= '</span>';
				$html .= '</a>';
			}
			elseif ($item->getType() == 'custom') {
				if (strpos($item->getUrl(), 'http:') !== false) $link = $item->getUrl();
				else 
					$link = $this->getBaseUrl().$item->getUrl();
				$class = $item->getClass().' level1';
				if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
				if ($this->isLinkActive($link)) $class .= ' active';
				if ($class) $class = ' class="'.$class.'" ';
				$rel = '';
				if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
				$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
				
				$html .= '<span class="mp-menu';
				if ($item->getImage_icon()) {
					$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
				}
				else $html .= '">';
				$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
				if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
				$html .= '</span>';
				$html .= '</a>';
			}
			else {
                // Hide link
            }
            
			$html .= $this->getMenuMegaLevelTwo( $item->getId(), $level + 1, $item->getSubmenu_content(), $item->getBlock() ); 
			
			$html .= '</div>';
			
			$count++;
		}
		
		
		foreach ($arrBlockIds as $blockId) {
			$title = $this->getBlockTitle($blockId);
			if ($title) {
				$html .= '<div class="magpassion-child-content';
				if ($count + 1 == $totalItems) $html .= ' last';
				$html .= '">';
				
				$html .= '<a href="#" title="'.$title.'"';
				$html .= ' class="level1"';
				$html .= '>';
				$html .= '<span class="mp-menu">';
				$html .= '<span class="mp-menu-title">'.$title.'</span>';
				$html .= $this->getLayout()->createBlock('cms/block')->setBlockId($blockId)->toHtml();
				$html .= '</span>';
				$html .= '</a>';
			
				$html .= '</div>';
				
				$count++;
			}
		}
		
		if ($totalItems > 0) {
			$html .= '</li></ul>';
		}
		
		return $html;
	}
	
	/**
	 * get menu html element for mega style
	 * @access public
	 * @return list menu html element
	 * @author MagPassion.com
	 */
	public function getMenuMega() {
		$html = '';
	
		$items = $this->getMenuItems(0);
		$totalItems = count($items);
		$count = 0;
		if ($totalItems > 0) {
			$html .= '<ul class="magpassion-advancedmenu magpassion-menu-mega level0">';
			
			foreach ($items as $item) {
				$class = '';
				if ($item->getClass()) $class = $item->getClass();
				if ($count+1 == $totalItems) $class .= ' last';
				else if ($count == 0) $class .= ' first';
				if ($class) $class = ' class="'.$class.'"';
				$html .= '<li'.$class.'>';
				if ($item->getType() == 'category') {
					$link = $this->getCategoryLink($item->getCategory_id());
					$linkNoSuffix = str_replace($this->categorySuffix,"", $link);
					$class = $item->getClass();
					if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
					if ($this->isLinkActive($linkNoSuffix)) $class .= ' active';
					if ($class) $class = ' class="'.$class.'" ';
					$rel = '';
					if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
					$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
					
					$html .= '<span class="mp-menu';
					if ($item->getImage_icon()) {
						$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
					}
					else $html .= '">';
					$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
					if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
					$html .= '</span>';
					$html .= '</a>';
				}
				elseif ($item->getType() == 'custom') {
					if (strpos($item->getUrl(), 'http:') !== false) $link = $item->getUrl();
					else 
						$link = $this->getBaseUrl().$item->getUrl();
					$class = $item->getClass();
					if ($this->hasChildMenuItems($item->getId())) $class .= ' hasChild';
					if ($this->isLinkActive($link)) $class .= ' active';
					if ($class) $class = ' class="'.$class.'" ';
					$rel = '';
					if ($item->getRel()) $rel = ' rel="'.$item->getRel().'"';
					$html .= '<a '.$class.$rel.' target="_'.$item->getLink_target().'" href="'.$link.'" title="'.$item->getTitle().'">';
					
					$html .= '<span class="mp-menu';
					if ($item->getImage_icon()) {
						$html .= ' hasImg" style="background-image:url('.Mage::helper('advancedmenu/menuitem_image')->init($item, 'image_icon')->keepTransparency(true)->resize(24, 24).');">';
					}
					else $html .= '">';
					$html .= '<span class="mp-menu-title">'.$item->getTitle().'</span>';
					if ($item->getDescription()) $html .= '<span class="mp-menu-des">'.$item->getDescription().'</span>';
					$html .= '</span>';
					$html .= '</a>';
				}
				else {
	                // Hide link
	            }
				
				$html .= $this->getMenuMegaLevelOne( $item->getId(), 1, $item->getSubmenu_content(), $item->getBlock()); 
				$html .= '</li>';
				
				$count++;
				
				$blocks = $item->getBlock();
			}
			
			$html .= '</ul>';
		}
		
		return $html;
	}
	
	/**
	 * draw menu 
	 * @access public
	 * @author MagPassion.com
	 */
	 
	public function drawMenu($menu_id, $menu_type) {
		$this->initMenuGroup();
		$this->currentUrl = Mage::helper('core/url')->getCurrentUrl();
		$html = '';
		$html .= '<div class="magpassion-nav-container">';
			$menu_class = 'magpassion-menu-dropdown';
			if ($menu_type == 'dropline') $menu_class = 'magpassion-menu-dropline';
			elseif ($menu_type == 'mega') $menu_class = 'magpassion-menu-mega';
			
			if ($menu_type == 'mega')
				$html .= $this->getMenuMega();
			else 
				$html .= $this->getMenuHtmlElements(0, 0, $menu_class, 'child', null);
			
		$html .= '</div>';
		
		return $html;
	}
} 