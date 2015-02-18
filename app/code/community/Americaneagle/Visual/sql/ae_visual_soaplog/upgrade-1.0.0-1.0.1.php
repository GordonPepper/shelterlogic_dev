<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 2/17/15
 * Time: 2:01 PM
 */

Mage::getModel('core/config_data')
	->load('aevisual/general/soaplog_enable', 'path')
	->setPath('aevisual/logging/soaplog_enable')
	->save();