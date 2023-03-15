<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Counter
 *
 * @author Mayar
 */
class Counter {

    private $_count;

    public function __construct() { //magic function (called with new)
        $this->_count = $this->getCount();
    }

    public function getCount() {
        if (file_exists(_counter_file_))
            $this->_count = intval(file_get_contents(_counter_file_));
        else {
            return 0;
        }
    }

    public function increment() {
        if (!isset($_SESSION[_session_key_counter])) {
            $this->_count++;
            $_SESSION[_session_key_counter] = true;
            return $this->_count;
        } else
            return false;
    }

    public function update_counter() {
        $fp = fopen(_counter_file_, "w+");
        fwrite($fp, $this->_count);
        fclose($fp);
    }

    public function incrementAndUpdate() {
        if ($this->increment() != false)
            $this->update_counter();
    }

}