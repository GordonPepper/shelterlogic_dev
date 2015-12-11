<?php
class Shelterlogic_Wishlist_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getWishlistUrl($product)
    {
        return Mage::helper('wishlist')->getAddUrl($product);
    }
}