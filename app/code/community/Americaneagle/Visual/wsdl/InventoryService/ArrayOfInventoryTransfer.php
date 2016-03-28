<?php

namespace Visual\InventoryService;

class ArrayOfInventoryTransfer implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryTransfer[] $InventoryTransfer
     */
    protected $InventoryTransfer = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryTransfer[]
     */
    public function getInventoryTransfer()
    {
      return $this->InventoryTransfer;
    }

    /**
     * @param InventoryTransfer[] $InventoryTransfer
     * @return \Visual\InventoryService\ArrayOfInventoryTransfer
     */
    public function setInventoryTransfer(array $InventoryTransfer = null)
    {
      $this->InventoryTransfer = $InventoryTransfer;
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
      return isset($this->InventoryTransfer[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryTransfer
     */
    public function offsetGet($offset)
    {
      return $this->InventoryTransfer[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryTransfer $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryTransfer[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryTransfer[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryTransfer Return the current element
     */
    public function current()
    {
      return current($this->InventoryTransfer);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryTransfer);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryTransfer);
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
      reset($this->InventoryTransfer);
    }

    /**
     * Countable implementation
     *
     * @return InventoryTransfer Return count of elements
     */
    public function count()
    {
      return count($this->InventoryTransfer);
    }

}
