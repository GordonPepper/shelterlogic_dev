<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$attrSet   = 'ShelterLogic';
$attrGroup = 'ShelterLogic';

$attrSetModel = Mage::getModel("eav/entity_attribute_set")
    ->setEntityTypeId($installer->getEntityTypeId('catalog_product'))
    ->setAttributeSetName($attrSet);
if ($attrSetModel->validate()) {
    $attrSetModel->save();
    $attrSetModel
        ->initFromSkeleton($installer->getDefaultAttributeSetId('catalog_product'))
        ->save();
}

$installer->addAttributeGroup('catalog_product', $attrSet, $attrGroup);

$installer->addTextAttribute(   'size',                 'Size',                 $attrSet, $attrGroup, 10);
$installer->addTextAttribute(   'marketing_bullet_1',   'Marketing Bullet 1',   $attrSet, $attrGroup, 20);
$installer->addTextAttribute(   'marketing_bullet_2',   'Marketing Bullet 2',   $attrSet, $attrGroup, 30);
$installer->addTextAttribute(   'marketing_bullet_3',   'Marketing Bullet 3',   $attrSet, $attrGroup, 40);
$installer->addTextAttribute(   'marketing_bullet_4',   'Marketing Bullet 4',   $attrSet, $attrGroup, 50);
$installer->addTextAttribute(   'marketing_bullet_5',   'Marketing Bullet 5',   $attrSet, $attrGroup, 60);
$installer->addTextAttribute(   'marketing_bullet_6',   'Marketing Bullet 6',   $attrSet, $attrGroup, 70);
$installer->addTextAttribute(   'marketing_bullet_7',   'Marketing Bullet 7',   $attrSet, $attrGroup, 80);
$installer->addTextAttribute(   'marketing_bullet_8',   'Marketing Bullet 8',   $attrSet, $attrGroup, 90);
$installer->addTextAttribute(   'marketing_bullet_9',   'Marketing Bullet 9',   $attrSet, $attrGroup, 100);
$installer->addTextAttribute(   'video_url',            'Video URL',            $attrSet, $attrGroup, 110);
$installer->addTextAttribute(   'peak_height',          'Peak Height (ft.)',    $attrSet, $attrGroup, 120);
$installer->addTextAttribute(   'wall_height',          'Wall Height (ft.)',    $attrSet, $attrGroup, 130);
$installer->addBooleanAttribute('valence',              'Valence',              $attrSet, $attrGroup, 140);
$installer->addBooleanAttribute('waterproof',           'Waterproof',           $attrSet, $attrGroup, 150);
$installer->addBooleanAttribute('water_resistant',      'Water-Resistant',      $attrSet, $attrGroup, 160);
$installer->addTextAttribute(   'fire_rated',           'Fire Rated',           $attrSet, $attrGroup, 170);
$installer->addTextAttribute(   'warranty',             'Warranty',             $attrSet, $attrGroup, 180);
$installer->addBooleanAttribute('storage_bag',          'Storage Bag',          $attrSet, $attrGroup, 190);
$installer->addBooleanAttribute('hardware_kit',         'Hardware Kit',         $attrSet, $attrGroup, 200);
$installer->addTextAttribute(   'cords_of_wood',        'Cords of Wood',        $attrSet, $attrGroup, 210);

$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'style', 111);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'width', 112);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'length', 113);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'height', 114);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'fabric_material', 115);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'fabric_color', 116);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'zipper_width_at_bottom', 131);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'zipper_width_at_top', 132);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'side_zipper_height', 133);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'middle_zipper_height', 134);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'wind_speed_rating', 135);
$installer->addAttributeToSet('catalog_product', $attrSet, $attrGroup, 'snow_load_rating', 136);

$installer->endSetup();
