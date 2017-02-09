<?php

namespace App\Utility;

/**
 * Flash:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Flash {

    /**
     * Message: Sets a session message or returns the value of a specific key of
     * the session.
     * @access public
     * @param string $key
     * @param string $value [optional]
     * @return string|null
     * @since 1.0.1
     */
    public static function message($key, $value = "") {
        if (Session::exists($key)) {
            $session = Session::get($key);
            Session::delete($key);
            return $session;
        } elseif (!empty($value)) {
            return(Session::put($key, $value));
        }
        return null;
    }

    /**
     * Danger: Sets a message or returns the value of the FLASH_DANGER key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function danger($value = "") {
        return(self::message(Config::get("FLASH_DANGER"), $value));
    }

    /**
     * Info: Sets a message or returns the value of the FLASH_INFO key of the
     * session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function info($value = "") {
        return(self::message(Config::get("FLASH_INFO"), $value));
    }

    /**
     * Success: Sets a message or returns the value of the FLASH_SUCCESS key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function success($value = "") {
        return(self::message(Config::get("FLASH_SUCCESS"), $value));
    }

    /**
     * Warning: Sets a message or returns the value of the FLASH_WARNING key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function warning($value = "") {
        return(self::message(Config::get("FLASH_WARNING"), $value));
    }

}
