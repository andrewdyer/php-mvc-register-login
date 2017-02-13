<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * User Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class User extends Core\Model {

    /** @var array The user's record from the database */
    private $_data = [];

    /**
     * Construct:
     * @access public
     * @param string $user [optional]
     * @since 1.0.2
     */
    public function __construct($user = null) {
        parent::__construct();
        $this->find($user);
    }

    /**
     * Create: Inserts a new user into the database, returning the unique user
     * if successful.
     * @access public
     * @param array $fields
     * @return string|boolean
     * @since 1.0.2
     * @throws Exception
     */
    public function create(array $fields) {
        if (!$userID = $this->Db->insert("users", $fields)) {
            throw new Exception(Utility\Text::get("USER_CREATE_EXCEPTION"));
        }
        return $userID;
    }

    /**
     * Data: Returns the user's record from the database.
     * @access public
     * @return array
     * @since 1.0.2
     */
    public function data() {
        return($this->_data);
    }

    /**
     * Exists: Returns true if the user's record has been pulled from the
     * database and stored in a class property, or false if not.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function exists() {
        return(!empty($this->_data));
    }

    /**
     * Get Instance: Returns an instance of the User model if the specified user
     * exists in the database. 
     * @access public
     * @param string $user
     * @return User|null
     * @since 1.0.2
     */
    public static function getInstance($user) {
        if (($User = new User($user))) {
            if ($User->exists()) {
                return $User;
            }
        }
        return null;
    }

    /**
     * Find: Retrieves and stores a specified user record from the database into
     * a class property. Returns true if the record was found, or false if not.
     * @access public
     * @param string $user
     * @return boolean
     * @since 1.0.2
     */
    public function find($user) {
        if ($user) {
            $field = filter_var($user, FILTER_VALIDATE_EMAIL) ? "email" : "id";
            $data = $this->Db->select("users", [$field, "=", $user]);
            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    /**
     * Update: Updates a specified user record in the database.
     * @access public
     * @param array $fields
     * @param integer $userID [optional]
     * @return void
     * @since 1.0.2
     * @throws Exception
     */
    public function update(array $fields, $userID = null) {
        if (!$userID) {
            $userID = $this->data()->id;
        }
        if (!$this->Db->update("users", $userID, $fields)) {
            throw new Exception(Utility\Text::get("USER_UPDATE_EXCEPTION"));
        }
    }

}
