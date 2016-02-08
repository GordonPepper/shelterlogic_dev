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

$connection->addColumn($this->getTable('advancedmenu/menuitem'), 'banner_url', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Banner URL'
));

$this->endSetup();