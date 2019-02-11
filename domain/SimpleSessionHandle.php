<?php
class SimpleSessionHandle implements SessionHandle {
    private $key;
    
    public function __construct($key) {
        $this->key = $key;
    }
    
    public function getValue($default = null) {
        return isset($_SESSION[$this->key]) ? $_SESSION[$this->key] : $default;
    }

    public function setValue($value) {
        $_SESSION[$this->key] = $value;
    }
}
