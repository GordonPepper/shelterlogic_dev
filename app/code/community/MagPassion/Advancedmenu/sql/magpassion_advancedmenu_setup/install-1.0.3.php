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
 * Advancedmenu module install script
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
$this->startSetup();

$table = $this->getConnection()
	->newTable($this->getTable('advancedmenu/menugroup'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Menu Group ID')
	->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'Name')

	->addColumn('type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'Type')
	
	->addColumn('show_menu_top_icon', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Top menu display image icon')
		
	->addColumn('show_submenu_icon', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Submenu display image icon')
	
	->addColumn('show_menu_top_des', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Top menu display description')
		
	->addColumn('show_submenu_des', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Submenu display description')
	
	->addColumn('background_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Top menu background Color')
	
	->addColumn('menu_level_top_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Top menu link color')
	
	->addColumn('menu_level_top_hover_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Top menu link hover color')
		
	->addColumn('menu_level_top_active_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Top menu link active color')
	
	->addColumn('submenu_background_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu background color')
	
	->addColumn('submenu_link_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu link color')
	
	->addColumn('submenu_link_hover_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu link hover color')
		
	->addColumn('submenu_link_hover_background_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu link hover background color')
	
	->addColumn('submenu_link_active_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu link active color')
		
	->addColumn('show_submenu_border', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Display border in submenu')
		
	->addColumn('submenu_border_color', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu border color')
			
	->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Status')

	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Menu Group Creation Time')
	->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Menu Group Modification Time')
	->setComment('Menu Group Table');
$this->getConnection()->createTable($table);

$table = $this->getConnection()
	->newTable($this->getTable('advancedmenu/menugroup_store'))
	->addColumn('menugroup_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable'  => false,
		'primary'   => true,
		), 'Menu Group ID')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Store ID')
	->addIndex($this->getIdxName('advancedmenu/menugroup_store', array('store_id')), array('store_id'))
	->addForeignKey($this->getFkName('advancedmenu/menugroup_store', 'menugroup_id', 'advancedmenu/menugroup', 'entity_id'), 'menugroup_id', $this->getTable('advancedmenu/menugroup'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey($this->getFkName('advancedmenu/menugroup_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Menu Groups To Store Linkage Table');
$this->getConnection()->createTable($table);
$table = $this->getConnection()
	->newTable($this->getTable('advancedmenu/menuitem'))
	->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Menu Item ID')
	->addColumn('menugroup_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned'  => true,
		), 'Menu Group')

	->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'Title')

	->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Description')

	->addColumn('type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable'  => false,
		), 'Type')

	->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Url')

	->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Category ID')

	->addColumn('category', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Category')
	
	->addColumn('menu_parent_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Parent ID')

	->addColumn('parent_item', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Parent Item')

	->addColumn('menuorder', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
		), 'Order')

	->addColumn('class', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Class')
    ->addColumn('rel', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Rel')
	->addColumn('link_target', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Link target')

	->addColumn('image_icon', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Image icon')

	->addColumn('submenu_content', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Submenu content')

	->addColumn('block', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		), 'Block')

	->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		), 'Status')

	->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Menu Item Creation Time')
	->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
		), 'Menu Item Modification Time')
	->addIndex($this->getIdxName('advancedmenu/menugroup', array('menugroup_id')), array('menugroup_id'))
	->setComment('Menu Item Table');
$this->getConnection()->createTable($table);

$table = $this->getConnection()
	->newTable($this->getTable('advancedmenu/menuitem_store'))
	->addColumn('menuitem_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'nullable'  => false,
		'primary'   => true,
		), 'Menu Item ID')
	->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
		), 'Store ID')
	->addIndex($this->getIdxName('advancedmenu/menuitem_store', array('store_id')), array('store_id'))
	->addForeignKey($this->getFkName('advancedmenu/menuitem_store', 'menuitem_id', 'advancedmenu/menuitem', 'entity_id'), 'menuitem_id', $this->getTable('advancedmenu/menuitem'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey($this->getFkName('advancedmenu/menuitem_store', 'store_id', 'core/store', 'store_id'), 'store_id', $this->getTable('core/store'), 'store_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->setComment('Menu Items To Store Linkage Table');
$this->getConnection()->createTable($table);
$this->endSetup();