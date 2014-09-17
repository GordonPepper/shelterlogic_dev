<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_CatalogSearch
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('catalogsearch_query')};
CREATE TABLE {$this->getTable('catalogsearch_query')} (
    `query_id` int(10) unsigned NOT NULL auto_increment,
    `query_text` varchar(255) NOT NULL default '',
    `num_results` int(10) unsigned NOT NULL default '0',
    `popularity` int(10) unsigned NOT NULL default '0',
    `redirect` varchar(255) NOT NULL default '',
    `synonim_for` varchar(255) NOT NULL default '',
    `store_id` smallint (5) unsigned NOT NULL,
    PRIMARY KEY  (`query_id`),
    KEY `search_query` (`query_text`,`popularity`),
    KEY `FK_catalogsearch_query` (`store_id`),
    CONSTRAINT `FK_catalogsearch_query` FOREIGN KEY (`store_id`) REFERENCES {$this->getTable('core_store')} (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup();
