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

/** @var Varien_Db_Adapter_Pdo_Mysql $connection */
$connection = $this->getConnection();
$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'featured_product', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Feature Product SKU'
));
$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'price_from', array(
    'type' => Varien_Db_Ddl_Table::TYPE_DECIMAL,
    'comment' => 'Price From',
    'length' => '12,4'
));
$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'banner_image', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Banner Image'
));
$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'banner_title', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Banner Title'
));
$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'banner_desc', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Banner Description'
));

$this->endSetup();