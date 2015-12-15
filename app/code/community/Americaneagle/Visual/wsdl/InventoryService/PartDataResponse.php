<?php

namespace Visual\InventoryService;

class PartDataResponse extends BaseDataResponse
{

    /**
     * @var int $PartCount
     */
    protected $PartCount = null;

    /**
     * @var ArrayOfPartListItem $PartList
     */
    protected $PartList = null;

    /**
     * @param boolean $HasErrors
     * @param \DateTime $SubmitDateTime
     * @param \DateTime $ResponseDateTime
     * @param int $PartCount
     */
    public function __construct($HasErrors, \DateTime $SubmitDateTime, \DateTime $ResponseDateTime, $PartCount)
    {
      parent::__construct($HasErrors, $SubmitDateTime, $ResponseDateTime);
      $this->PartCount = $PartCount;
    }

    /**
     * @return int
     */
    public function getPartCount()
    {
      return $this->PartCount;
    }

    /**
     * @param int $PartCount
     * @return \Visual\InventoryService\PartDataResponse
     */
    public function setPartCount($PartCount)
    {
      $this->PartCount = $PartCount;
      return $this;
    }

    /**
     * @return ArrayOfPartListItem
     */
    public function getPartList()
    {
      return $this->PartList;
    }

    /**
     * @param ArrayOfPartListItem $PartList
     * @return \Visual\InventoryService\PartDataResponse
     */
    public function setPartList($PartList)
    {
      $this->PartList = $PartList;
      return $this;
    }

}
