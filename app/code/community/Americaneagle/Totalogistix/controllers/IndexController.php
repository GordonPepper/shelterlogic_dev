<?php

class Americaneagle_Totalogistix_IndexController
    extends Mage_Core_Controller_Front_Action {


   public function checkAction() {

       try {
           $params = json_decode(file_get_contents('php://input'));
           $isValid = Mage::helper('americaneagle_totalogistix')->isValidAlaskaCity($params[0]->city);
           echo json_encode($isValid);
       } catch (Exception $e) {
           echo json_encode(array('error' => $e->getMessage(),
               'stack' => $e->getTrace()
           ));
       }
    }

}