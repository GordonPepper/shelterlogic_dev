<?php

namespace Visual\SalesOrderService;

class ArrayOfUDFValue implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UDFValue[] $UDFValue
     */
    protected $UDFValue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UDFValue[]
     */
    public function getUDFValue()
    {
      return $this->UDFValue;
    }

    /**
     * @param UDFValue[] $UDFValue
     * @return \Visual\SalesOrderService\ArrayOfUDFValue
     */
    public function setUDFValue(array $UDFValue = null)
    {
      $this->UDFValue = $UDFValue;
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
      return isset($this->UDFValue[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UDFValue
     */
    public function offsetGet($offset)
    {
      return $this->UDFValue[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UDFValue $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UDFValue[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UDFValue[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UDFValue Return the current element
     */
    public function current()
    {
      return current($this->UDFValue);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UDFValue);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UDFValue);
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
      reset($this->UDFValue);
    }

    /**
     * Countable implementation
     *
     * @return UDFValue Return count of elements
     */
    public function count()
    {
      return count($this->UDFValue);
    }

}
