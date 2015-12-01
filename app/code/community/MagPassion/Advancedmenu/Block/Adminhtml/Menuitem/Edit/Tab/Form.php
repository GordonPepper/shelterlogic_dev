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
 * Menu Item edit form tab
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Block_Adminhtml_Menuitem_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{	
	/**
	 * prepare the form
	 * @access protected
	 * @return Advancedmenu_Menuitem_Block_Adminhtml_Menuitem_Edit_Tab_Form
	 * @author MagPassion.com
	 */
	protected function getListCategories($catid, $level = 0) {
		$prefix = '';
        $strCat = '';
		for ($i = 0; $i < $level; $i++) {
            $prefix .= '---';
        }

		$categories=Mage::getModel('catalog/category')->load($catid)->getChildrenCategories();
		foreach($categories as $cat){ 
			$category=Mage::getModel('catalog/category')->load($cat->entity_id);
			$strCat .= $category->getId().':::'.$prefix.$category->getName().'@@@';			
			$strCat .= $this->getListCategories($category->getId(), $level+1);
		}
		return $strCat;
	}
	
	protected function _prepareForm(){
		$form = new Varien_Data_Form(array(
            'enctype' => 'multipart/form-data',
        ));
		$form->setHtmlIdPrefix('menuitem_');
		$form->setFieldNameSuffix('menuitem');
		$this->setForm($form);
		$fieldset = $form->addFieldset('menuitem_form', array('legend'=>Mage::helper('advancedmenu')->__('Menu Item')));
		$fieldset->addType('image', Mage::getConfig()->getBlockClassName('advancedmenu/adminhtml_menuitem_helper_image'));
		$values = Mage::getResourceModel('advancedmenu/menugroup_collection')->toOptionArray();
		array_unshift($values, array('label'=>'', 'value'=>''));		
		$fieldset->addField('menugroup_id', 'select', array(
			'label' 	=> Mage::helper('advancedmenu')->__('Menu Group'),
			'name'  	=> 'menugroup_id',
			'required'  => true,
			'values'	=> $values
		));

		$fieldset->addField('title', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Title'),
			'name'  => 'title',
			'required'  => true,
			'class' => 'required-entry',

		));

		$fieldset->addField('description', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Description'),
			'name'  => 'description',

		));

		$fieldset->addField('type', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Type'),
			'name'  => 'type',
			'required'  => true,
			'class' => 'required-entry',
			'values'=> array(
				array(
					'value' => 'custom',
					'label' => Mage::helper('advancedmenu')->__('Custom url'),
				),
				array(
					'value' => 'category',
					'label' => Mage::helper('advancedmenu')->__('Category'),
				),
                array(
					'value' => 'blank',
					'label' => Mage::helper('advancedmenu')->__('Hide link'),
				),
			),
            'note' => 'Choose "Hide link" to hide tag a in this menu item, use with Mega menu to customized display of column',
			'value' => 'custom',
			'onchange' => "changeMenuItemType()",
		));

		$fieldset->addField('url', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Url'),
			'name'  => 'url',

		));
		
		$cateoptions = array();
        $rootCategories = array();
        $websites = Mage::getModel('core/website')->getCollection();
        foreach ($websites as $website) {
            $rootCategories[] = $website->getDefaultStore()->getRootCategoryId();
        }
        $rootCategories = array_unique($rootCategories);
        foreach ($rootCategories as $parentid) {
            $strCategories = $this->getListCategories($parentid);
            $arrCate = explode("@@@", $strCategories);
            foreach ($arrCate as $c) {
                if ($c) {
                    $tmp = explode(":::", $c);
                    $cateoptions[] = array(
                        'label' => $tmp[1],
                        'value' => $tmp[0],
                    );
                }
            }
        }

		//print_r($cateoptions);
		
		$fieldset->addField('category_id', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Category'),
			'name'  => 'category_id',
			'values'=> $cateoptions,
			'onchange' => "changeCategory()",
		));

		$fieldset->addField('category', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Category'),
			'name'  => 'category',

		));
		
		$parents = Mage::getModel('advancedmenu/menuitem')->getCollection();
		$current_id = -10;
		if( Mage::registry('menuitem_data') && Mage::registry('menuitem_data')->getId() ) $current_id  = Mage::registry('menuitem_data')->getId();
		$parentoptions = array();
		$parentoptions[] = array(
					'label' => 'None',
					'value' => 0
					);
		foreach ($parents as $p) 
			if ((string)$p->getId() != (string)$current_id) {
				$parentoptions[] = array(
					'label' => (string)$p->getTitle(),
					'value' => $p->getId()
					);
			}

		$fieldset->addField('menu_parent_id', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Parent'),
			'name'  => 'menu_parent_id',
			'values'=> $parentoptions,
			'onchange' => "changeParent()",
		));

		$fieldset->addField('parent_item', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Parent Item'),
			'name'  => 'parent_item',
		));

		$fieldset->addField('menuorder', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Order'),
			'name'  => 'menuorder',
			'class' => 'validate-number',
		));

		$fieldset->addField('class', 'text', array(
			'label' => Mage::helper('advancedmenu')->__('Class'),
			'name'  => 'class',

		));
		
		$fieldset->addField('rel', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Rel'),
			'name'  => 'rel',
			'values'=> array(
                array(
					'value' => '',
					'label' => Mage::helper('advancedmenu')->__('none'),
				),
				array(
					'value' => 'alternate',
					'label' => Mage::helper('advancedmenu')->__('alternate'),
				),
				array(
					'value' => 'author',
					'label' => Mage::helper('advancedmenu')->__('author'),
				),
                array(
					'value' => 'bookmark',
					'label' => Mage::helper('advancedmenu')->__('bookmark'),
				),
				array(
					'value' => 'help',
					'label' => Mage::helper('advancedmenu')->__('help'),
				),
                array(
					'value' => 'license',
					'label' => Mage::helper('advancedmenu')->__('license'),
				),
				array(
					'value' => 'next',
					'label' => Mage::helper('advancedmenu')->__('next'),
				),
                array(
					'value' => 'nofollow',
					'label' => Mage::helper('advancedmenu')->__('nofollow'),
				),
				array(
					'value' => 'noreferrer',
					'label' => Mage::helper('advancedmenu')->__('noreferrer'),
				),
                array(
					'value' => 'prefetch',
					'label' => Mage::helper('advancedmenu')->__('prefetch'),
				),
				array(
					'value' => 'prev',
					'label' => Mage::helper('advancedmenu')->__('prev'),
				),
                array(
					'value' => 'search',
					'label' => Mage::helper('advancedmenu')->__('search'),
				),
				array(
					'value' => 'tag',
					'label' => Mage::helper('advancedmenu')->__('tag'),
				),
			),
			'value' => '',
		));

		$fieldset->addField('link_target', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Link target'),
			'name'  => 'link_target',
			'values'=> array(
				array(
					'value' => 'parent',
					'label' => Mage::helper('advancedmenu')->__('current window or tab'),
				),
				array(
					'value' => 'blank',
					'label' => Mage::helper('advancedmenu')->__('new window or tab'),
				),
			),
			'value' => 'parent',
		));

		$fieldset->addField('submenu_content', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Submenu content'),
			'name'  => 'submenu_content',
			'values'=> array(
				array(
					'value' => 'child',
					'label' => Mage::helper('advancedmenu')->__('Child menu items only'),
				),
				array(
					'value' => 'block',
					'label' => Mage::helper('advancedmenu')->__('Block content only'),
				),
				array(
					'value' => 'childblock',
					'label' => Mage::helper('advancedmenu')->__('Child menu items and block content'),
				),
                array(
                    'value' => 'featuredproduct',
                    'label' => Mage::helper('advancedmenu')->__('Child menu items and featured product'),
                ),
                array(
                    'value' => 'banner',
                    'label' => Mage::helper('advancedmenu')->__('Child menu items and image banner'),
                ),
			),
			'value' => 'child',
		));
		
		$blocks = Mage::getResourceModel('cms/block_collection')->toOptionArray();
		array_unshift($blocks, array('label'=>'', 'value'=>''));
		$newblocks = array();
		foreach ($blocks as $block) {
			if ($block['value']) $newblocks[] = $block;
		}
		
		$fieldset->addField('block', 'multiselect', array(
			'label' => Mage::helper('advancedmenu')->__('Block'),
			'name'  => 'block',
			'values'=> $newblocks,
			
		));

        $fieldset->addField('featured_product', 'text', array(
            'label' => Mage::helper('advancedmenu')->__('Featured Product SKU'),
            'name'  => 'featured_product',
        ));

        $fieldset->addField('price_from', 'text', array(
            'label' => Mage::helper('advancedmenu')->__('Featured Product Price From'),
            'name'  => 'price_from',
        ));

        $fieldset->addField('banner_image', 'image', array(
            'label' => Mage::helper('advancedmenu')->__('Banner Image'),
            'name'  => 'banner_image',

        ));

        $fieldset->addField('banner_title', 'text', array(
            'label'     => Mage::helper('advancedmenu')->__('Banner Title'),
            'required'  => false,
            'name'      => 'banner_title',
        ));

        $fieldset->addField('banner_desc', 'textarea', array(
            'label'     => Mage::helper('advancedmenu')->__('Banner Description'),
            'required'  => false,
            'name'      => 'banner_desc',
        ));


        $fieldset->addField('status', 'select', array(
			'label' => Mage::helper('advancedmenu')->__('Status'),
			'name'  => 'status',
			'values'=> array(
				array(
					'value' => 1,
					'label' => Mage::helper('advancedmenu')->__('Enabled'),
				),
				array(
					'value' => 0,
					'label' => Mage::helper('advancedmenu')->__('Disabled'),
				),
			),
		));
		if (Mage::app()->isSingleStoreMode()){
			$fieldset->addField('store_id', 'hidden', array(
                'name'      => 'stores[]',
                'value'     => Mage::app()->getStore(true)->getId()
            ));
            Mage::registry('current_menuitem')->setStoreId(Mage::app()->getStore(true)->getId());
		}
		if (Mage::getSingleton('adminhtml/session')->getMenuitemData()){
			$form->setValues(Mage::getSingleton('adminhtml/session')->getMenuitemData());
			Mage::getSingleton('adminhtml/session')->setMenuitemData(null);
		}
		elseif (Mage::registry('current_menuitem')){
			$form->setValues(Mage::registry('current_menuitem')->getData());
		}
		return parent::_prepareForm();
	}
}