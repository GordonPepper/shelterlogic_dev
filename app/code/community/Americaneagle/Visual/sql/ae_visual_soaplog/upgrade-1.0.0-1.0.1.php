<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 2/17/15
 * Time: 2:01 PM
 */

$installer = $this;

$installer->startSetup();

$installer->getConnection()->modifyColumn(
	$this->getTable('americaneagle_visual/soaplog'), 'datetime', 'DATETIME'
);



$cfg = Mage::getModel('core/config_data')
	->load('aevisual/general/soaplog_enable', 'path');
if($cfg->getId()) {
	$cfg->setPath('aevisual/logging/soaplog_enable')
		->save();
}


$installer->endSetup();
