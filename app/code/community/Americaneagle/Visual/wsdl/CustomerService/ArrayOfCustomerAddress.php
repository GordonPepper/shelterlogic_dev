<?php

namespace Visual\CustomerService;

class ArrayOfCustomerAddress implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerAddress[] $CustomerAddress
     */
    protected $CustomerAddress = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerAddress[]
     */
    public function getCustomerAddress()
    {
      return $this->CustomerAddress;
    }

    /**
     * @param CustomerAddress[] $CustomerAddress
     * @return \Visual\CustomerService\ArrayOfCustomerAddress
     */
    public function setCustomerAddress(array $CustomerAddress = null)
    {
      $this->CustomerAddress = $CustomerAddress;
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
      return isset($this->CustomerAddress[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerAddress
     */
    public function offsetGet($offset)
    {
      return $this->CustomerAddress[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerAddress $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerAddress[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerAddress[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerAddress Return the current element
     */
    public function current()
    {
      return current($this->CustomerAddress);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerAddress);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerAddress);
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
      reset($this->CustomerAddress);
    }

    /**
     * Countable implementation
     *
     * @return CustomerAddress Return count of elements
     */
    public function count()
    {
      return count($this->CustomerAddress);
    }

}
