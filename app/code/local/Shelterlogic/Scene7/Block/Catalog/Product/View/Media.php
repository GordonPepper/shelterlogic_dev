<?php
class Shelterlogic_Scene7_Block_Catalog_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{
    public function getGalleryImages()
    {
        $gallery = array();
        $product = $this->getProduct();
        $searchProduct = Mage::registry('searchProduct');
        if(isset($searchProduct) && is_null($product->getScene7Addition())) {
            $product = $searchProduct;
        }
        if ($additionalImages = $product->getScene7Addition()) {
            $additionalImages = explode("\n", $additionalImages);
            foreach ($additionalImages as $image) {
                // Ignore image that the same as main one
                if (strpos($image, '%5F01?') !== false) continue;

                if (trim($image)) {
                    $gallery[] = new Varien_Object(array('file' => trim($image)));
                }
            }
        }

        return empty($gallery) ? parent::getGalleryImages() : $gallery;
    }

}