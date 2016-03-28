<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/25/16
 * Time: 10:51 AM
 */

require('Americaneagle/Visual/wsdl/UserDefinedFieldService/autoload.php');

use Visual\UserDefinedFieldService as UserDefinedFieldService;

class Americaneagle_Visual_Helper_UserDefinedFieldService extends Americaneagle_Visual_Helper_Visual
{
    /** @var Visual\UserDefinedFieldService\UserDefinedFieldService */
    private $userDefinedFieldService;

    public function __construct()
    {
        parent::__construct();
        $this->userDefinedFieldService = new UserDefinedFieldService\UserDefinedFieldService($this->getOptions());
        $this->userDefinedFieldService->__setSoapHeaders($this->getHeader());
    }

    /**
     * @param $documentId, $programId, $fieldId
     * @return null|string
     */
    public function getWebLogin($clientID) {
        try {
            $udfvalue = new UserDefinedFieldService\UDFValue();
            $udfvalue->setDocumentID($clientID)
            ->setProgramID("VMCUSMNT")
            ->setID("UDF-0000066");

            $udfarray = new UserDefinedFieldService\ArrayOfUDFValue();
            $udfarray->setUDFValue(array($udfvalue));

            $udfdata = new UserDefinedFieldService\UDFData();
            $udfdata->setUDFValueList($udfarray);

            $data = new UserDefinedFieldService\SearchUserDefined();
            $data->setData($udfdata);

            $res = $this->userDefinedFieldService->SearchUserDefined($data);
            if($res->getSearchUserDefinedResult()->getUDFValues()->getUDFValueResponse() != null) {
                $webLogin = current($res->getSearchUserDefinedResult()->getUDFValues()->getUDFValueResponse())->getUDFValue()->getStringValue();
            } else {
                $webLogin = null;
            }

            $this->soapLog($this->userDefinedFieldService, 'UserDefinedFieldService:SearchUserDefined', sprintf('Get the email address %s', print_r($data, true)));
            return $webLogin != null ? $webLogin : null;
        } catch (Exception $e) {
            $this->soapLogException(isset($this->userDefinedFieldService) ? $this->userDefinedFieldService : null, 'UserDefinedFieldService:SearchUserDefined', sprintf('Exception: %s', $e->getMessage()));
            //throw $e;
            return null;
        }
    }
}