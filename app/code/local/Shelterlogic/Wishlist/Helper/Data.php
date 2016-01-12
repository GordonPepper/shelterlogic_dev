<?php
class Shelterlogic_Wishlist_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getWishlistUrl($product)
    {
        return str_replace('wishlist/index/add', 'slwishlist/ajax/add', Mage::helper('wishlist')->getAddUrl($product));
    }
}