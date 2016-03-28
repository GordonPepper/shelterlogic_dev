<?php

namespace Visual\SalesOrderService;

class ArrayOfReference implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var Reference[] $Reference
     */
    protected $Reference = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return Reference[]
     */
    public function getReference()
    {
      return $this->Reference;
    }

    /**
     * @param Reference[] $Reference
     * @return \Visual\SalesOrderService\ArrayOfReference
     */
    public function setReference(array $Reference = null)
    {
      $this->Reference = $Reference;
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
      return isset($this->Reference[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return Reference
     */
    public function offsetGet($offset)
    {
      return $this->Reference[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param Reference $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->Reference[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->Reference[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return Reference Return the current element
     */
    public function current()
    {
      return current($this->Reference);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->Reference);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->Reference);
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
      reset($this->Reference);
    }

    /**
     * Countable implementation
     *
     * @return Reference Return count of elements
     */
    public function count()
    {
      return count($this->Reference);
    }

}
