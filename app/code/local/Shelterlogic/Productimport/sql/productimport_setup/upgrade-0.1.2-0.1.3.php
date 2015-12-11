<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run('UPDATE catalog_category_entity_text SET value = NULL where attribute_id = 65'); // available_sort_by
$installer->run('UPDATE catalog_category_entity_varchar SET value = NULL where attribute_id = 66'); // default_sort_by
$installer->run('UPDATE catalog_category_entity_int SET value = 1 where attribute_id = 51'); // is_anchor

$installer->endSetup();
