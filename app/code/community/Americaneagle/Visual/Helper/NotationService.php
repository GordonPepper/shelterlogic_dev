<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 6/9/16
 * Time: 12:51 PM
 */

require('Americaneagle/Visual/wsdl/NotationService/autoload.php');

use Visual\NotationService as NotationService;

class Americaneagle_Visual_Helper_NotationService extends Americaneagle_Visual_Helper_Visual
{
    /** @var Visual\NotationService\NotationService */
    private $notationService;

    public function __construct()
    {
        parent::__construct();
        $this->notationService = new NotationService\NotationService($this->getOptions());
        $this->notationService->__setSoapHeaders($this->getHeader());
    }

    public function addNotation($orderId, $note)
    {
        $notationData = new NotationService\NotationData();
        $notationData->setUserID("SYSADM");
        $notationData->setNotationType("CO");
        $notationData->setOwnerID($orderId);
        $notationData->setNote($note);
        $this->notationService->AddNotation(new NotationService\AddNotation($notationData));
    }
}