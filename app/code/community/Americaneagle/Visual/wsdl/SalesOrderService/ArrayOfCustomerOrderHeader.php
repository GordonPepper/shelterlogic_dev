<?php

namespace Visual\SalesOrderService;

class ArrayOfCustomerOrderHeader implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerOrderHeader[] $CustomerOrderHeader
     */
    protected $CustomerOrderHeader = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerOrderHeader[]
     */
    public function getCustomerOrderHeader()
    {
      return $this->CustomerOrderHeader;
    }

    /**
     * @param CustomerOrderHeader[] $CustomerOrderHeader
     * @return \Visual\SalesOrderService\ArrayOfCustomerOrderHeader
     */
    public function setCustomerOrderHeader(array $CustomerOrderHeader = null)
    {
      $this->CustomerOrderHeader = $CustomerOrderHeader;
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
      return isset($this->CustomerOrderHeader[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerOrderHeader
     */
    public function offsetGet($offset)
    {
      return $this->CustomerOrderHeader[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerOrderHeader $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerOrderHeader[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerOrderHeader[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerOrderHeader Return the current element
     */
    public function current()
    {
      return current($this->CustomerOrderHeader);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerOrderHeader);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerOrderHeader);
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
      reset($this->CustomerOrderHeader);
    }

    /**
     * Countable implementation
     *
     * @return CustomerOrderHeader Return count of elements
     */
    public function count()
    {
      return count($this->CustomerOrderHeader);
    }

}
