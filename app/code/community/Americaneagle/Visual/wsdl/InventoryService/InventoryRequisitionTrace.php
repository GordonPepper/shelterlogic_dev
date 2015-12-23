<?php

namespace Visual\InventoryService;

class InventoryRequisitionTrace extends TraceLocation
{

    /**
     * @var \DateTime $ExpirationDate
     */
    protected $ExpirationDate = null;

    /**
     * @var string $Aproperty1
     */
    protected $Aproperty1 = null;

    /**
     * @param float $Quantity
     */
    public function __construct($Quantity)
    {
      parent::__construct($Quantity);
    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
      if ($this->ExpirationDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->ExpirationDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $ExpirationDate
     * @return \Visual\InventoryService\InventoryRequisitionTrace
     */
    public function setExpirationDate(\DateTime $ExpirationDate = null)
    {
      if ($ExpirationDate == null) {
       $this->ExpirationDate = null;
      } else {
        $this->ExpirationDate = $ExpirationDate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getAproperty1()
    {
      return $this->Aproperty1;
    }

    /**
     * @param string $Aproperty1
     * @return \Visual\InventoryService\InventoryRequisitionTrace
     */
    public function setAproperty1($Aproperty1)
    {
      $this->Aproperty1 = $Aproperty1;
      return $this;
    }

}
