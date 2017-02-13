<?php

namespace App\Utility;

/**
 * Input:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Input {

    /**
     * Check: Validates an input source against a defined set of validation
     * rules, returning true if the validation passed or storing the errors in
     * the session and returning false if not.
     * @access public
     * @param array $source
     * @param array $inputs
     * @return boolean
     * @since 1.0.2
     */
    public static function check(array $source, array $inputs) {
        $Validate = new Validate($source);
        $validation = $Validate->check($inputs);
        if (!$validation->passed()) {
            Session::put(Config::get("SESSION_ERRORS"), $validation->errors());
            return false;
        }
        return true;
    }

    /**
     * Exists: Determines if a request exists by checking if the GET or POST
     * super-global is empty.
     * @access public
     * @param string $source [optional]
     * @return boolean
     * @since 1.0.1
     */
    public static function exists($source = "post") {
        switch ($source) {
            case 'post':
                return(!empty($_POST));
            case 'get':
                return(!empty($_GET));
        }
        return false;
    }

    /**
     * Get: Returns the value of a specific key of the GET super-global.
     * @access public
     * @param string $key
     * @return string
     * @since 1.0.1
     */
    public static function get($key) {
        return(isset($_GET[$key]) ? $_GET[$key] : "");
    }

    /**
     * Post: Returns the value of a specific key of the POST super-global.
     * @access public
     * @param string $key
     * @return string
     * @since 1.0.1
     */
    public static function post($key) {
        return(isset($_POST[$key]) ? $_POST[$key] : "");
    }

}
