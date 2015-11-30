<?php
class Shelterlogic_Scene7_Block_Catalog_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{
    public function getGalleryImages()
    {
        $gallery = array();
        if ($additionalImages = $this->getProduct()->getScene7Addition()) {
            $additionalImages = explode("\n", $additionalImages);
            foreach ($additionalImages as $image) {
                if (trim($image)) {
                    $gallery[] = new Varien_Object(array('file' => trim($image)));
                }
            }
        }

        return empty($gallery) ? parent::getGalleryImages() : $gallery;
    }

}