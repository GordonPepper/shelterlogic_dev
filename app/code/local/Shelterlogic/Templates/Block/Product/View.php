<?php
class Shelterlogic_Templates_Block_Product_View extends Mage_Catalog_Block_Product_View
{
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
}