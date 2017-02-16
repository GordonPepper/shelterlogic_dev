<?php

$installer = $this;
$installer->startSetup();

/*$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->startSetup();*/

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('morecc')};
CREATE TABLE {$this->getTable('morecc')} (
  `morecc_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `cus_id` int(11) NULL,
  `number` varchar(255) NOT NULL default '',
  `card_type` varchar(255) NOT NULL default '',
  `expr_month` varchar(255) NOT NULL default '',
  `expr_year` varchar(255) NOT NULL default '',
  `profile_id` varchar(255) NOT NULL default '',
  `pay_id` varchar(255) NOT NULL default '',
  `ship_id` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`morecc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");


/*$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'authcim_shipping_id', array(
	'label'				=> 'Auth.net CIM - Shipping ID',
	'type'				=> 'varchar',
	'input'				=> 'text',
	'default'           => '',
	'position' 			=> 100,
	'visible'           => true,
	'required'          => false,
	'user_defined'      => true,
	'searchable'        => false,
	'filterable'        => false,
	'comparable'        => false,
	'visible_on_front'  => false,
	'unique'            => false
));
$setup->addAttributeToGroup( $entityTypeId, $attributeSetId, $attributeGroupId, 'authcim_shipping_id', '999' );*/

$installer->endSetup(); 
//$setup->endSetup();
