<?php

namespace Visual\NotationService;

class NotationData
{

    /**
     * @var string $UserID
     */
    protected $UserID = null;

    /**
     * @var string $NotationType
     */
    protected $NotationType = null;

    /**
     * @var string $OwnerID
     */
    protected $OwnerID = null;

    /**
     * @var string $Note
     */
    protected $Note = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getUserID()
    {
      return $this->UserID;
    }

    /**
     * @param string $UserID
     * @return \Visual\NotationService\NotationData
     */
    public function setUserID($UserID)
    {
      $this->UserID = $UserID;
      return $this;
    }

    /**
     * @return string
     */
    public function getNotationType()
    {
      return $this->NotationType;
    }

    /**
     * @param string $NotationType
     * @return \Visual\NotationService\NotationData
     */
    public function setNotationType($NotationType)
    {
      $this->NotationType = $NotationType;
      return $this;
    }

    /**
     * @return string
     */
    public function getOwnerID()
    {
      return $this->OwnerID;
    }

    /**
     * @param string $OwnerID
     * @return \Visual\NotationService\NotationData
     */
    public function setOwnerID($OwnerID)
    {
      $this->OwnerID = $OwnerID;
      return $this;
    }

    /**
     * @return string
     */
    public function getNote()
    {
      return $this->Note;
    }

    /**
     * @param string $Note
     * @return \Visual\NotationService\NotationData
     */
    public function setNote($Note)
    {
      $this->Note = $Note;
      return $this;
    }

}
