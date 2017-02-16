<?php

namespace Visual\SalesOrderService;

class ArrayOfUserDefinedFieldValue implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UserDefinedFieldValue[] $UserDefinedFieldValue
     */
    protected $UserDefinedFieldValue = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UserDefinedFieldValue[]
     */
    public function getUserDefinedFieldValue()
    {
      return $this->UserDefinedFieldValue;
    }

    /**
     * @param UserDefinedFieldValue[] $UserDefinedFieldValue
     * @return \Visual\SalesOrderService\ArrayOfUserDefinedFieldValue
     */
    public function setUserDefinedFieldValue(array $UserDefinedFieldValue = null)
    {
      $this->UserDefinedFieldValue = $UserDefinedFieldValue;
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
      return isset($this->UserDefinedFieldValue[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UserDefinedFieldValue
     */
    public function offsetGet($offset)
    {
      return $this->UserDefinedFieldValue[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UserDefinedFieldValue $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UserDefinedFieldValue[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UserDefinedFieldValue[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UserDefinedFieldValue Return the current element
     */
    public function current()
    {
      return current($this->UserDefinedFieldValue);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UserDefinedFieldValue);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UserDefinedFieldValue);
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
      reset($this->UserDefinedFieldValue);
    }

    /**
     * Countable implementation
     *
     * @return UserDefinedFieldValue Return count of elements
     */
    public function count()
    {
      return count($this->UserDefinedFieldValue);
    }

}
