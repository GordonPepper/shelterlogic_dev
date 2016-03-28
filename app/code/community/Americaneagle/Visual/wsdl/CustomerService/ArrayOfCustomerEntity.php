<?php

namespace Visual\CustomerService;

class ArrayOfCustomerEntity implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerEntity[] $CustomerEntity
     */
    protected $CustomerEntity = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerEntity[]
     */
    public function getCustomerEntity()
    {
      return $this->CustomerEntity;
    }

    /**
     * @param CustomerEntity[] $CustomerEntity
     * @return \Visual\CustomerService\ArrayOfCustomerEntity
     */
    public function setCustomerEntity(array $CustomerEntity = null)
    {
      $this->CustomerEntity = $CustomerEntity;
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
      return isset($this->CustomerEntity[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerEntity
     */
    public function offsetGet($offset)
    {
      return $this->CustomerEntity[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerEntity $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerEntity[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerEntity[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerEntity Return the current element
     */
    public function current()
    {
      return current($this->CustomerEntity);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerEntity);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerEntity);
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
      reset($this->CustomerEntity);
    }

    /**
     * Countable implementation
     *
     * @return CustomerEntity Return count of elements
     */
    public function count()
    {
      return count($this->CustomerEntity);
    }

}
