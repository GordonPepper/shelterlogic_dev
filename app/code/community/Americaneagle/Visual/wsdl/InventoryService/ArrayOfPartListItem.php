<?php

namespace Visual\InventoryService;

class ArrayOfPartListItem implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var PartListItem[] $PartListItem
     */
    protected $PartListItem = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return PartListItem[]
     */
    public function getPartListItem()
    {
      return $this->PartListItem;
    }

    /**
     * @param PartListItem[] $PartListItem
     * @return \Visual\InventoryService\ArrayOfPartListItem
     */
    public function setPartListItem(array $PartListItem = null)
    {
      $this->PartListItem = $PartListItem;
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
      return isset($this->PartListItem[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return PartListItem
     */
    public function offsetGet($offset)
    {
      return $this->PartListItem[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param PartListItem $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->PartListItem[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->PartListItem[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return PartListItem Return the current element
     */
    public function current()
    {
      return current($this->PartListItem);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->PartListItem);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->PartListItem);
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
      reset($this->PartListItem);
    }

    /**
     * Countable implementation
     *
     * @return PartListItem Return count of elements
     */
    public function count()
    {
      return count($this->PartListItem);
    }

}
