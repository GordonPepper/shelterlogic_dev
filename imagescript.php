<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/30/14
 * Time: 4:28 PM
 */


exit; // don't run by accident!


// Change current directory to the directory of current script
chdir(dirname(__FILE__));

require 'app/Mage.php';

if (!Mage::isInstalled()) {
	echo "Application is not installed yet, please complete install wizard first.";
	exit;
}

// Only for urls
// Don't remove this
$_SERVER['SCRIPT_NAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_NAME']);
$_SERVER['SCRIPT_FILENAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_FILENAME']);

$app = Mage::app('admin');
$app->setUseSessionInUrl(false);

umask(0);


$collection = Mage::getModel('catalog/product')->getCollection();

$collection->addAttributeToSelect(array('style','width','height'));
$collection->addAttributeToFilter('type_id', 'simple');
$collection->addAttributeToFilter('attribute_set_id','10');
//$collection->getSelect()->limit(10);

/** @var Mage_Core_Modle_Resource $dbResource */
$dbResource = Mage::getSingleton('core/resource');

/** @var Magento_Db_Adapter_Pdo_Mysql $dbConn */
$dbConn = $dbResource->getConnection('core_write');

foreach($collection as $p) {
	$style = $p->getResource()->getAttribute('style')->getFrontend()->getValue($p);
	$width = $p->getResource()->getAttribute('width')->getFrontend()->getValue($p);
	$height = $p->getResource()->getAttribute('height')->getFrontend()->getValue($p);
	$smap = array(
		'Round Frame' => 'RD',
		'Peak Frame' => 'PK',
		'Barn Frame' => 'BN'
	);
	$pmap = array(
		'RD' => 'R',
		'PK' => 'P',
		'BN' => 'B'
	);
	$style = $smap[$style];
	$importDir = Mage::getBaseDir('media') . DS . 'import';
	$destDir = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'product';

	$sourcePath = sprintf("%s/%s/%s_%sx%s.png", $importDir, $style, $pmap[$style], $width, $height);
	$dbPath = strtolower(sprintf("/%s/_/%s_%sx%s.png", $pmap[$style], $pmap[$style], $width, $height));
	$destPath = strtolower(sprintf("%s%s", $destDir, $dbPath));

	$dcheck = explode('/',$destPath);
	array_pop($dcheck);
	if(!file_exists(implode('/', $dcheck))){
		echo sprintf("going to create dir %s\n", implode('/', $dcheck));
		mkdir(implode('/', $dcheck), 0777, true);
	}

	if(!file_exists($destPath)){
		try{
			echo sprintf("going to copy file %s to %s\n", $sourcePath, $destPath);
			copy($sourcePath,$destPath);
		} catch (Exception $e) {
			echo 'fatal exception: ' . $e->getMessage();
		}
	} else {
		echo sprintf("file %s exists, moving on\n", $destPath);
	}


	$count = $dbConn->update(
		'catalog_product_entity_varchar',
		array('value' => $dbPath),
		array(
			'entity_id=?' => $p->getId(),
			'1' => new Zend_Db_Expr(sprintf("attribute_id in (%s)", implode(', ', array(85,86,87))))
		)
	);
	if($count == 0){
		$dbConn->insert(
			'catalog_product_entity_varchar',
			array(
				'entity_type_id' => 4,
				'attribute_id' => 85,
				'store_id' => 0,
				'entity_id' => $p->getId(),
				'value' => $dbPath
			)
		);
		$dbConn->insert(
			'catalog_product_entity_varchar',
			array(
				'entity_type_id' => 4,
				'attribute_id' => 86,
				'store_id' => 0,
				'entity_id' => $p->getId(),
				'value' => $dbPath
			)
		);
		$dbConn->insert(
			'catalog_product_entity_varchar',
			array(
				'entity_type_id' => 4,
				'attribute_id' => 87,
				'store_id' => 0,
				'entity_id' => $p->getId(),
				'value' => $dbPath
			)
		);

	}
	$dbConn->insert(
		'catalog_product_entity_media_gallery',
		array(
			'attribute_id' => 88,
			'entity_id' => $p->getId(),
			'value' => $dbPath
		));

	$valueid = $dbConn->lastInsertId();
	$dbConn->insert(
		'catalog_product_entity_media_gallery_value',
		array(
			'value_id' => $valueid,
			'store_id' => 0,
			'label' => null,
			'position' => 1,
			'disabled' => 0
		)
	);

	echo sprintf("updated values for product sku %s\n", $p->getSku());
}