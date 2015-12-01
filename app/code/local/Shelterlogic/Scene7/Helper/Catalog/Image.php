<?php
class Shelterlogic_Scene7_Helper_Catalog_Image extends Mage_Catalog_Helper_Image
{
    public function __toString()
    {
        if ($imageFile = $this->getProduct()->getScene7Main()) {
            // In case image file is set directly (i.e gallery images)
            if ($this->getImageFile()) {
                $imageFile = $this->getImageFile();
            }

            // If width is set, get the dynamic size instead of preset
            if ($width = $this->_getModel()->getWidth()) {
                $height = $this->_getModel()->getHeight() ? $this->_getModel()->getHeight() : $width;
                $imageFile = substr($imageFile, 0, strpos($imageFile, '?'));
                $imageFile .= sprintf('?wid=%s&hei=%s', $width, $height);
            }

            return $imageFile;
        } else {
            return parent::__toString();
        }
    }
}