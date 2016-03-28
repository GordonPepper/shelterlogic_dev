<?php

namespace Visual\UserDefinedFieldService;

class ArrayOfUDFValueResponse implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UDFValueResponse[] $UDFValueResponse
     */
    protected $UDFValueResponse = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UDFValueResponse[]
     */
    public function getUDFValueResponse()
    {
      return $this->UDFValueResponse;
    }

    /**
     * @param UDFValueResponse[] $UDFValueResponse
     * @return \Visual\UserDefinedFieldService\ArrayOfUDFValueResponse
     */
    public function setUDFValueResponse(array $UDFValueResponse = null)
    {
      $this->UDFValueResponse = $UDFValueResponse;
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
      return isset($this->UDFValueResponse[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UDFValueResponse
     */
    public function offsetGet($offset)
    {
      return $this->UDFValueResponse[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UDFValueResponse $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UDFValueResponse[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UDFValueResponse[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UDFValueResponse Return the current element
     */
    public function current()
    {
      return current($this->UDFValueResponse);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UDFValueResponse);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UDFValueResponse);
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
      reset($this->UDFValueResponse);
    }

    /**
     * Countable implementation
     *
     * @return UDFValueResponse Return count of elements
     */
    public function count()
    {
      return count($this->UDFValueResponse);
    }

}
