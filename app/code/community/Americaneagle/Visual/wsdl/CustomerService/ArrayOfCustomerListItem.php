<?php

namespace Visual\CustomerService;

class ArrayOfCustomerListItem implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerListItem[] $CustomerListItem
     */
    protected $CustomerListItem = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerListItem[]
     */
    public function getCustomerListItem()
    {
      return $this->CustomerListItem;
    }

    /**
     * @param CustomerListItem[] $CustomerListItem
     * @return \Visual\CustomerService\ArrayOfCustomerListItem
     */
    public function setCustomerListItem(array $CustomerListItem = null)
    {
      $this->CustomerListItem = $CustomerListItem;
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
      return isset($this->CustomerListItem[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerListItem
     */
    public function offsetGet($offset)
    {
      return $this->CustomerListItem[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerListItem $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerListItem[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerListItem[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerListItem Return the current element
     */
    public function current()
    {
      return current($this->CustomerListItem);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerListItem);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerListItem);
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
      reset($this->CustomerListItem);
    }

    /**
     * Countable implementation
     *
     * @return CustomerListItem Return count of elements
     */
    public function count()
    {
      return count($this->CustomerListItem);
    }

}
