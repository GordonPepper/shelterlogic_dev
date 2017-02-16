<?php

namespace Visual\InventoryService;

class ArrayOfInventoryRequisitionTrace implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryRequisitionTrace[] $InventoryRequisitionTrace
     */
    protected $InventoryRequisitionTrace = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryRequisitionTrace[]
     */
    public function getInventoryRequisitionTrace()
    {
      return $this->InventoryRequisitionTrace;
    }

    /**
     * @param InventoryRequisitionTrace[] $InventoryRequisitionTrace
     * @return \Visual\InventoryService\ArrayOfInventoryRequisitionTrace
     */
    public function setInventoryRequisitionTrace(array $InventoryRequisitionTrace = null)
    {
      $this->InventoryRequisitionTrace = $InventoryRequisitionTrace;
      return $this;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset An offset to check for
     * @return boolean true on success or false on failure
     */
    public function offsetExists($offset)
    {
      return isset($this->InventoryRequisitionTrace[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryRequisitionTrace
     */
    public function offsetGet($offset)
    {
      return $this->InventoryRequisitionTrace[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryRequisitionTrace $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryRequisitionTrace[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryRequisitionTrace[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryRequisitionTrace Return the current element
     */
    public function current()
    {
      return current($this->InventoryRequisitionTrace);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryRequisitionTrace);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryRequisitionTrace);
    }

    /**
     * Iterator implementation
     *
     * @return boolean Return the validity of the current position
     */
    public function valid()
    {
      return $this->key() !== null;
    }

    /**
     * Iterator implementation
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
      reset($this->InventoryRequisitionTrace);
    }

    /**
     * Countable implementation
     *
     * @return InventoryRequisitionTrace Return count of elements
     */
    public function count()
    {
      return count($this->InventoryRequisitionTrace);
    }

}
