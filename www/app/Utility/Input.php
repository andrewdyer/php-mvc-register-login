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
     * Exists: Determines if a request exists by checking if the GET or POST
     * super-global is empty.
     * @access public
     * @param string $type [optional]
     * @return boolean
     * @since 1.0.1
     */
    public static function exists($type = "post") {
        switch ($type) {
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
