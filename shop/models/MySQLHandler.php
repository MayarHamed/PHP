<?php

require 'config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MySQLHandler
 *
 * @author webre
 */
class MySQLHandler {

    private $_db_handler;
    private $_table;

    public function __construct($table) {
        $this->_table = $table;
        $this->connect();
    }

    public function connect() {
        try {
            $handler = mysqli_connect(__HOST__, __USER__, __PASS__, __DB__);
            if ($handler) {
                $this->_db_handler = $handler;
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("something went wrong");
        }
    }

    public function disconnect() {
        if ($this->_db_handler)
            mysqli_close($this->_db_handler);
    }

    public function get_all_records($fields = array(), $start = 0) {
        $table = $this->_table;
        if (empty($fields)) {
            $sql = "select * from `$table`";
        } else {
            $sql = "select ";
            foreach ($fields as $f) {
                $sql .= " `$f`, ";
            }
            $sql .= "from  `$table` ";
            $sql = str_replace(", from", "from", $sql);
        }
        $sql .= "limit $start," . __RECORDS_PER_PAGE__;
        return $this->get_results($sql);
    }

    private function get_results($sql) {
        $this->debug($sql);
        $_handler_results = mysqli_query($this->_db_handler, $sql);
        $_arr_results = array();

        if ($_handler_results) {
            while ($row = mysqli_fetch_array($_handler_results, MYSQLI_ASSOC)) {
                $_arr_results[] = array_change_key_case($row);
            }
            $this->disconnect();
            return $_arr_results;
        } else {
            $this->disconnect();
            return false;
        }
    }

    public function get_record_by_id($id) {

        $table = $this->_table;
        $sql = "select * from `$table` where id = `$id` ";
        return $this->get_results($sql);
    }

    public function save_or_update($fields, $record) {
        $sql = "INSERT INTO " . $this->_table . " VALUES (";
        foreach ($record as $value) {
            $sql .= "?,";
        }
    }
}
