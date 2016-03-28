<?php

namespace Visual\UserDefinedFieldService;

class ArrayOfUDFLabelResponse implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UDFLabelResponse[] $UDFLabelResponse
     */
    protected $UDFLabelResponse = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UDFLabelResponse[]
     */
    public function getUDFLabelResponse()
    {
      return $this->UDFLabelResponse;
    }

    /**
     * @param UDFLabelResponse[] $UDFLabelResponse
     * @return \Visual\UserDefinedFieldService\ArrayOfUDFLabelResponse
     */
    public function setUDFLabelResponse(array $UDFLabelResponse = null)
    {
      $this->UDFLabelResponse = $UDFLabelResponse;
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
      return isset($this->UDFLabelResponse[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UDFLabelResponse
     */
    public function offsetGet($offset)
    {
      return $this->UDFLabelResponse[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UDFLabelResponse $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UDFLabelResponse[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UDFLabelResponse[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UDFLabelResponse Return the current element
     */
    public function current()
    {
      return current($this->UDFLabelResponse);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UDFLabelResponse);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UDFLabelResponse);
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
      reset($this->UDFLabelResponse);
    }

    /**
     * Countable implementation
     *
     * @return UDFLabelResponse Return count of elements
     */
    public function count()
    {
      return count($this->UDFLabelResponse);
    }

}
