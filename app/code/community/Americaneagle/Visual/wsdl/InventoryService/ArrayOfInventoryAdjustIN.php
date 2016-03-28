<?php

namespace Visual\InventoryService;

class ArrayOfInventoryAdjustIN implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryAdjustIN[] $InventoryAdjustIN
     */
    protected $InventoryAdjustIN = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryAdjustIN[]
     */
    public function getInventoryAdjustIN()
    {
      return $this->InventoryAdjustIN;
    }

    /**
     * @param InventoryAdjustIN[] $InventoryAdjustIN
     * @return \Visual\InventoryService\ArrayOfInventoryAdjustIN
     */
    public function setInventoryAdjustIN(array $InventoryAdjustIN = null)
    {
      $this->InventoryAdjustIN = $InventoryAdjustIN;
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
      return isset($this->InventoryAdjustIN[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryAdjustIN
     */
    public function offsetGet($offset)
    {
      return $this->InventoryAdjustIN[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryAdjustIN $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryAdjustIN[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryAdjustIN[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryAdjustIN Return the current element
     */
    public function current()
    {
      return current($this->InventoryAdjustIN);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryAdjustIN);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryAdjustIN);
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
      reset($this->InventoryAdjustIN);
    }

    /**
     * Countable implementation
     *
     * @return InventoryAdjustIN Return count of elements
     */
    public function count()
    {
      return count($this->InventoryAdjustIN);
    }

}
