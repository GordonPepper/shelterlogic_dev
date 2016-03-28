<?php

namespace Visual\UserDefinedFieldService;

class ArrayOfUserDefinedFieldValueResponse implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UserDefinedFieldValueResponse[] $UserDefinedFieldValueResponse
     */
    protected $UserDefinedFieldValueResponse = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UserDefinedFieldValueResponse[]
     */
    public function getUserDefinedFieldValueResponse()
    {
      return $this->UserDefinedFieldValueResponse;
    }

    /**
     * @param UserDefinedFieldValueResponse[] $UserDefinedFieldValueResponse
     * @return \Visual\UserDefinedFieldService\ArrayOfUserDefinedFieldValueResponse
     */
    public function setUserDefinedFieldValueResponse(array $UserDefinedFieldValueResponse = null)
    {
      $this->UserDefinedFieldValueResponse = $UserDefinedFieldValueResponse;
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
      return isset($this->UserDefinedFieldValueResponse[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UserDefinedFieldValueResponse
     */
    public function offsetGet($offset)
    {
      return $this->UserDefinedFieldValueResponse[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UserDefinedFieldValueResponse $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UserDefinedFieldValueResponse[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UserDefinedFieldValueResponse[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UserDefinedFieldValueResponse Return the current element
     */
    public function current()
    {
      return current($this->UserDefinedFieldValueResponse);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UserDefinedFieldValueResponse);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UserDefinedFieldValueResponse);
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
      reset($this->UserDefinedFieldValueResponse);
    }

    /**
     * Countable implementation
     *
     * @return UserDefinedFieldValueResponse Return count of elements
     */
    public function count()
    {
      return count($this->UserDefinedFieldValueResponse);
    }

}
