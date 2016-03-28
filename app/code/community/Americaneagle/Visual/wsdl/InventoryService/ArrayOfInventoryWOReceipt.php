<?php

namespace Visual\InventoryService;

class ArrayOfInventoryWOReceipt implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryWOReceipt[] $InventoryWOReceipt
     */
    protected $InventoryWOReceipt = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryWOReceipt[]
     */
    public function getInventoryWOReceipt()
    {
      return $this->InventoryWOReceipt;
    }

    /**
     * @param InventoryWOReceipt[] $InventoryWOReceipt
     * @return \Visual\InventoryService\ArrayOfInventoryWOReceipt
     */
    public function setInventoryWOReceipt(array $InventoryWOReceipt = null)
    {
      $this->InventoryWOReceipt = $InventoryWOReceipt;
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
      return isset($this->InventoryWOReceipt[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryWOReceipt
     */
    public function offsetGet($offset)
    {
      return $this->InventoryWOReceipt[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryWOReceipt $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryWOReceipt[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryWOReceipt[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryWOReceipt Return the current element
     */
    public function current()
    {
      return current($this->InventoryWOReceipt);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryWOReceipt);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryWOReceipt);
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
      reset($this->InventoryWOReceipt);
    }

    /**
     * Countable implementation
     *
     * @return InventoryWOReceipt Return count of elements
     */
    public function count()
    {
      return count($this->InventoryWOReceipt);
    }

}
