<?php

namespace App\Utility;

use PDO;
use PDOException;

/**
 * Database:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Database {

    /** @var Database */
    private static $_Database = null;

    /** @var PDO */
    private $_PDO = null;

    /** @var PDOStatement */
    private $_query = null;

    /** @var boolean */
    private $_error = false;

    /** @var array */
    private $_results = [];

    /** @var integer */
    private $_count = 0;

    /**
     * Construct:
     * @access private
     * @since 1.0.1
     */
    private function __construct() {
        try {
            $host = Config::get("DATABASE_HOST");
            $name = Config::get("DATABASE_NAME");
            $username = Config::get("DATABASE_USERNAME");
            $password = Config::get("DATABASE_PASSWORD");
            $this->_PDO = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Action:
     * @access public
     * @param string $action
     * @param string $table
     * @param array $where [optional]
     * @return Database|boolean
     * @since 1.0.1
     */
    public function action($action, $table, array $where = []) {
        if (count($where) === 3) {
            $operator = $where[1];
            $operators = ["=", ">", "<", ">=", "<="];
            if (in_array($operator, $operators)) {
                $field = $where[0];
                $value = $where[2];
                $params = [":value" => $value];
                if (!$this->query("{$action} FROM `{$table}` WHERE `{$field}` {$operator} :value", $params)->error()) {
                    return $this;
                }
            }
        } else {
            if (!$this->query("{$action} FROM `{$table}`")->error()) {
                return $this;
            }
        }
        return false;
    }

    /**
     * Count:
     * @access public
     * @return integer
     * @since 1.0.1
     */
    public function count() {
        return($this->_count);
    }

    /**
     * Delete:
     * @access public
     * @param string $table
     * @param array $where [optional]
     * @return Database|boolean
     * @since 1.0.1
     */
    public function delete($table, array $where = []) {
        return($this->action('DELETE', $table, $where));
    }

    /**
     * Error:
     * @access public
     * @return boolean
     * @since 1.0.1
     */
    public function error() {
        return($this->_error);
    }

    /**
     * First:
     * @access public
     * @return array
     * @since 1.0.1
     */
    public function first() {
        return($this->results(0));
    }

    /**
     * Get Instance:
     * @access public
     * @return Database
     * @since 1.0.1
     */
    public static function getInstance() {
        if (!isset(self::$_Database)) {
            self::$_Database = new Database();
        }
        return(self::$_Database);
    }

    /**
     * Insert:
     * @access public
     * @param string $table
     * @param array $fields
     * @return string|boolean
     * @since 1.0.1
     */
    public function insert($table, array $fields) {
        if (count($fields)) {
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
            }
            $columns = implode("`, `", array_keys($fields));
            $values = implode(", ", array_keys($params));
            if (!$this->query("INSERT INTO `{$table}` (`{$columns}`) VALUES({$values})", $params)->error()) {
                return($this->_PDO->lastInsertId());
            }
        }
        return false;
    }

    /**
     * Query:
     * @access public
     * @param string $sql
     * @param array $params [optional]
     * @return Database
     * @since 1.0.1
     */
    public function query($sql, array $params = []) {
        $this->_count = 0;
        $this->_error = false;
        $this->_results = [];
        if (($this->_query = $this->_PDO->prepare($sql))) {
            foreach ($params as $key => $value) {
                $this->_query->bindValue($key, $value);
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
                //die(print_r($this->_query->errorInfo()));
            }
        }
        return $this;
    }

    /**
     * Results:
     * @access public
     * @param integer $key [optional]
     * @return array
     * @since 1.0.1
     */
    public function results($key = null) {
        return(isset($key) ? $this->_results[$key] : $this->_results);
    }

    /**
     * Select:
     * @access public
     * @param string $table
     * @param array $where [optional]
     * @return Database|boolean
     * @since 1.0.1
     */
    public function select($table, array $where = []) {
        return($this->action('SELECT *', $table, $where));
    }

    /**
     * Update:
     * @access public
     * @param string $table
     * @param string $id
     * @param array $fields
     * @return boolean
     * @since 1.0.1
     */
    public function update($table, $id, array $fields) {
        if (count($fields)) {
            $x = 1;
            $set = "";
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
                $set .= "`{$key}` = :$key";
                if ($x < count($fields)) {
                    $set .= ", ";
                }
                $x ++;
            }
            if (!$this->query("UPDATE `{$table}` SET {$set} WHERE `id` = {$id}", $params)->error()) {
                return true;
            }
        }
        return false;
    }

}
