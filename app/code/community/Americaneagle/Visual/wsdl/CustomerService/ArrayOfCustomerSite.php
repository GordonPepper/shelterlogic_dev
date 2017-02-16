<?php

namespace Visual\CustomerService;

class ArrayOfCustomerSite implements \ArrayAccess, \Iterator, \Countable
{

    /**
     * @var CustomerSite[] $CustomerSite
     */
    protected $CustomerSite = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return CustomerSite[]
     */
    public function getCustomerSite()
    {
      return $this->CustomerSite;
    }

    /**
     * @param CustomerSite[] $CustomerSite
     * @return \Visual\CustomerService\ArrayOfCustomerSite
     */
    public function setCustomerSite(array $CustomerSite = null)
    {
      $this->CustomerSite = $CustomerSite;
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
      return isset($this->CustomerSite[$offset]);
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to retrieve
     * @return CustomerSite
     */
    public function offsetGet($offset)
    {
      return $this->CustomerSite[$offset];
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to assign the value to
     * @param CustomerSite $value The value to set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
      $this->CustomerSite[$offset] = $value;
    }

    /**
     * ArrayAccess implementation
     *
     * @param mixed $offset The offset to unset
     * @return void
     */
    public function offsetUnset($offset)
    {
      unset($this->CustomerSite[$offset]);
    }

    /**
     * Iterator implementation
     *
     * @return CustomerSite Return the current element
     */
    public function current()
    {
      return current($this->CustomerSite);
    }

    /**
     * Iterator implementation
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
      next($this->CustomerSite);
    }

    /**
     * Iterator implementation
     *
     * @return string|null Return the key of the current element or null
     */
    public function key()
    {
      return key($this->CustomerSite);
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
      reset($this->CustomerSite);
    }

    /**
     * Countable implementation
     *
     * @return CustomerSite Return count of elements
     */
    public function count()
    {
      return count($this->CustomerSite);
    }

}
