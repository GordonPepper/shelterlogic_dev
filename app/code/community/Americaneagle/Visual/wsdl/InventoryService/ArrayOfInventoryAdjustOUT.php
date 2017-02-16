<?php

namespace Visual\InventoryService;

class ArrayOfInventoryAdjustOUT implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryAdjustOUT[] $InventoryAdjustOUT
     */
    protected $InventoryAdjustOUT = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryAdjustOUT[]
     */
    public function getInventoryAdjustOUT()
    {
      return $this->InventoryAdjustOUT;
    }

    /**
     * @param InventoryAdjustOUT[] $InventoryAdjustOUT
     * @return \Visual\InventoryService\ArrayOfInventoryAdjustOUT
     */
    public function setInventoryAdjustOUT(array $InventoryAdjustOUT = null)
    {
      $this->InventoryAdjustOUT = $InventoryAdjustOUT;
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
      return isset($this->InventoryAdjustOUT[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryAdjustOUT
     */
    public function offsetGet($offset)
    {
      return $this->InventoryAdjustOUT[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryAdjustOUT $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryAdjustOUT[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryAdjustOUT[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryAdjustOUT Return the current element
     */
    public function current()
    {
      return current($this->InventoryAdjustOUT);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryAdjustOUT);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryAdjustOUT);
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
      reset($this->InventoryAdjustOUT);
    }

    /**
     * Countable implementation
     *
     * @return InventoryAdjustOUT Return count of elements
     */
    public function count()
    {
      return count($this->InventoryAdjustOUT);
    }

}
