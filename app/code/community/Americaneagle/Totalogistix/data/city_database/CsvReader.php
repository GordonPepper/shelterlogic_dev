<?php

/**
 * Created by PhpStorm.
 * User: astayart
 * Date: 2/13/16
 * Time: 11:36 AM
 */
class CsvReader
{
    private $fileName;
    private $handle;
    private $hMap;
    private $delimiter;
    private $data;

    public function __construct($fn, $d, $head) {
        $this->fileName = $fn;
        $this->delimiter = $d;
        $this->handle = fopen($this->fileName, "r");
        if ($this->handle !== false) {
            if ($head) {
                $map = array();
                $fields = fgetcsv($this->handle, 0, $this->delimiter);
                if ($fields === false) {
                    return false;
                }
                for ($i = 0; $i < count($fields); $i++) {
                    $map[$fields[$i]] = $i;
                }
                $this->hMap = $map;
            }
        } else {
            return false;
        }
    }

    public function getAssociative($fields = null) {
        $aa = array();
        foreach ($this->hMap as $key => $val) {
            if (is_array($fields)) {
                if (isset($fields[$key])) {
                    $aa[$fields[$key]] = $this->data[$val];
                }
            } else {
                $aa[$key] = $this->data[$val];
            }
        }
        return $aa;
    }

    public function nextRow() {
        $this->data = fgetcsv($this->handle, 0, $this->delimiter);
        return $this->data;
    }

    public function item($field, $value = null) {
        if (isset($value)) {
            if (isset($this->hMap[$field])) {
                $this->data[$this->hMap[$field]] = $value;
            } else {
                $this->data[] = $value;
                $this->hMap[$field] = count($this->hMap);
            }
            return true;
        }
        if (is_array($this->data)) {
            return $this->data[$this->hMap[$field]];
        }
        return false;
    }

    public function close() {
        if ($this->handle) {
            fclose($this->handle);
        }
    }

    public function getMap() {
        return $this->hMap;
    }

    public function getData() {
        return $this->data;
    }

    public function getRow($keys = null) {
        if (empty($keys)) {
            return $this->data;
        }
        $row = array();
        foreach ($keys as $key) {
            $row[] = $this->item($key);
        }
        return $row;
    }

    public function rewind() {
        rewind($this->handle);
        if (isset($this->hMap)) {
            $this->nextRow();
        }
    }
}
