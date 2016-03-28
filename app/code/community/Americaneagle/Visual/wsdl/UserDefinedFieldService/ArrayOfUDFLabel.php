<?php

namespace Visual\UserDefinedFieldService;

class ArrayOfUDFLabel implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var UDFLabel[] $UDFLabel
     */
    protected $UDFLabel = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return UDFLabel[]
     */
    public function getUDFLabel()
    {
      return $this->UDFLabel;
    }

    /**
     * @param UDFLabel[] $UDFLabel
     * @return \Visual\UserDefinedFieldService\ArrayOfUDFLabel
     */
    public function setUDFLabel(array $UDFLabel = null)
    {
      $this->UDFLabel = $UDFLabel;
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
      return isset($this->UDFLabel[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return UDFLabel
     */
    public function offsetGet($offset)
    {
      return $this->UDFLabel[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param UDFLabel $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->UDFLabel[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->UDFLabel[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return UDFLabel Return the current element
     */
    public function current()
    {
      return current($this->UDFLabel);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->UDFLabel);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->UDFLabel);
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
      reset($this->UDFLabel);
    }

    /**
     * Countable implementation
     *
     * @return UDFLabel Return count of elements
     */
    public function count()
    {
      return count($this->UDFLabel);
    }

}
