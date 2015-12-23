<?php
class Shelterlogic_Templates_Block_Product_View extends Mage_Catalog_Block_Product_View
{
    const XML_PATH_MARKETING_TITLE  = 'shelterlogic/product_detail/marketing_title';
    const XML_PATH_MARKETING_DESC   = 'shelterlogic/product_detail/marketing_description';

    public function getMarketingBullets()
    {
        $result = array();

        for ($i = 1; $i <= 9; $i++) {
            $marketingBullet = $this->getProduct()->getData('marketing_bullet_' . $i);
            if (!$marketingBullet) continue;
            $marketingBullet = explode('||', $marketingBullet);
            $title = count($marketingBullet) == 2 ? $marketingBullet[0] : '';
            $content = $title ? $marketingBullet[1] : $marketingBullet[0];
            $result[] = array(
                'title' => $title,
                'content' => $content
            );
        }

        return $result;
    }

    public function getMarketingTitle()
    {
        $marketingTitle = trim($this->getProduct()->getData('marketing_block_title'));
        if (!$marketingTitle) {
            $marketingTitle = Mage::getStoreConfig(self::XML_PATH_MARKETING_TITLE);
        }

        return $marketingTitle;
    }

    public function getMarketingDescription()
    {
        $marketingDesc = trim($this->getProduct()->getData('marketing_block_description'));
        if (!$marketingDesc) {
            $marketingDesc = Mage::getStoreConfig(self::XML_PATH_MARKETING_DESC);
        }

        return $marketingDesc;

    }
}