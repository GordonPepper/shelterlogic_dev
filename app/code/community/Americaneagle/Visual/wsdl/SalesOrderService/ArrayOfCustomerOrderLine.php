<?php

namespace Visual\SalesOrderService;

class ArrayOfCustomerOrderLine implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerOrderLine[] $CustomerOrderLine
     */
    protected $CustomerOrderLine = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerOrderLine[]
     */
    public function getCustomerOrderLine()
    {
      return $this->CustomerOrderLine;
    }

    /**
     * @param CustomerOrderLine[] $CustomerOrderLine
     * @return \Visual\SalesOrderService\ArrayOfCustomerOrderLine
     */
    public function setCustomerOrderLine(array $CustomerOrderLine = null)
    {
      $this->CustomerOrderLine = $CustomerOrderLine;
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
      return isset($this->CustomerOrderLine[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerOrderLine
     */
    public function offsetGet($offset)
    {
      return $this->CustomerOrderLine[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerOrderLine $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerOrderLine[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerOrderLine[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerOrderLine Return the current element
     */
    public function current()
    {
      return current($this->CustomerOrderLine);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerOrderLine);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerOrderLine);
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
      reset($this->CustomerOrderLine);
    }

    /**
     * Countable implementation
     *
     * @return CustomerOrderLine Return count of elements
     */
    public function count()
    {
      return count($this->CustomerOrderLine);
    }

}
