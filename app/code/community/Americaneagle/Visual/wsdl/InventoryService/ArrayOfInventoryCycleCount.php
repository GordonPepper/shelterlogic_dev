<?php

namespace Visual\InventoryService;

class ArrayOfInventoryCycleCount implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryCycleCount[] $InventoryCycleCount
     */
    protected $InventoryCycleCount = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryCycleCount[]
     */
    public function getInventoryCycleCount()
    {
      return $this->InventoryCycleCount;
    }

    /**
     * @param InventoryCycleCount[] $InventoryCycleCount
     * @return \Visual\InventoryService\ArrayOfInventoryCycleCount
     */
    public function setInventoryCycleCount(array $InventoryCycleCount = null)
    {
      $this->InventoryCycleCount = $InventoryCycleCount;
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
      return isset($this->InventoryCycleCount[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryCycleCount
     */
    public function offsetGet($offset)
    {
      return $this->InventoryCycleCount[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryCycleCount $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryCycleCount[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryCycleCount[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryCycleCount Return the current element
     */
    public function current()
    {
      return current($this->InventoryCycleCount);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryCycleCount);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryCycleCount);
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
      reset($this->InventoryCycleCount);
    }

    /**
     * Countable implementation
     *
     * @return InventoryCycleCount Return count of elements
     */
    public function count()
    {
      return count($this->InventoryCycleCount);
    }

}
