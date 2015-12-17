<?php
class Shelterlogic_Wishlist_Block_Js extends Enterprise_Wishlist_Block_Customer_Sidebar
{
    public function getWishlistProductsJson()
    {
        $result = array();
        if ($this->hasWishlistItems()) {
            foreach ($this->getWishlistItems() as $item) {
                /** @var Mage_Wishlist_Model_Item $item */
                $result[] = $item->getProductId();
            }
        }

        return json_encode($result);
    }

    protected function _toHtml()
    {
        if (!$this->getTemplate()) {
            return '';
        }
        $html = $this->renderView();
        return $html;
    }
}