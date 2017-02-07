<?php

namespace App\Utility;

/**
 * Cookie:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Cookie {

    /**
     * Delete:
     * @access public
     * @param string $key
     * @return void
     * @since 1.0.1
     */
    public static function delete($key) {
        self::put($key, "", time() - 1);
    }

    /**
     * Exists:
     * @access public
     * @param string $key
     * @return boolean
     * @since 1.0.1
     */
    public static function exists($key) {
        return(isset($_COOKIE[$key]));
    }

    /**
     * Get: Returns the value of a specific key of the COOKIE super-global
     * @access public
     * @param string $key
     * @return string
     * @since 1.0.1
     */
    public static function get($key) {
        return($_COOKIE[$key]);
    }

    /**
     * Put:
     * @access public
     * @param string $key
     * @param string $value
     * @param integer $expiry
     * @return boolean
     * @since 1.0.1
     */
    public static function put($key, $value, $expiry) {
        return(setcookie($key, $value, time() + $expiry, "/"));
    }

}
