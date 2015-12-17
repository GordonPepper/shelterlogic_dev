<?php
class Altima_Lookbook_Block_Single extends Altima_Lookbook_Block_Lookbook
{
    protected function _construct()
    {
//        $this->addData(array(
//            'cache_lifetime' => false,
//            'cache_tags'     => array(Altima_Lookbook_Model_Lookbook::CACHE_TAG),
//        ));

        $this->setTemplate('lookbook/single.phtml');
    }

    public function getCacheKey()
    {
        return 'lookbook_slide_' . $this->getLookbookId();
    }

    public function getLookbook()
    {
        $lookbook = Mage::getModel('lookbook/lookbook')->load($this->getLookbookId());
        if ($lookbook->getId() && $lookbook->getStatus() == Altima_Lookbook_Model_Status::STATUS_ENABLED) {
            return $lookbook;
        } else {
            return null;
        }
    }
}