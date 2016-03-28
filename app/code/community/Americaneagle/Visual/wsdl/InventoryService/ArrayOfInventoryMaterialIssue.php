<?php

namespace Visual\InventoryService;

class ArrayOfInventoryMaterialIssue implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var InventoryMaterialIssue[] $InventoryMaterialIssue
     */
    protected $InventoryMaterialIssue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InventoryMaterialIssue[]
     */
    public function getInventoryMaterialIssue()
    {
      return $this->InventoryMaterialIssue;
    }

    /**
     * @param InventoryMaterialIssue[] $InventoryMaterialIssue
     * @return \Visual\InventoryService\ArrayOfInventoryMaterialIssue
     */
    public function setInventoryMaterialIssue(array $InventoryMaterialIssue = null)
    {
      $this->InventoryMaterialIssue = $InventoryMaterialIssue;
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
      return isset($this->InventoryMaterialIssue[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return InventoryMaterialIssue
     */
    public function offsetGet($offset)
    {
      return $this->InventoryMaterialIssue[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param InventoryMaterialIssue $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->InventoryMaterialIssue[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->InventoryMaterialIssue[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return InventoryMaterialIssue Return the current element
     */
    public function current()
    {
      return current($this->InventoryMaterialIssue);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->InventoryMaterialIssue);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->InventoryMaterialIssue);
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
      reset($this->InventoryMaterialIssue);
    }

    /**
     * Countable implementation
     *
     * @return InventoryMaterialIssue Return count of elements
     */
    public function count()
    {
      return count($this->InventoryMaterialIssue);
    }

}
