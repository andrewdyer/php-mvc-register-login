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
     * Session: Sets a session message or returns the value of a specific key of
     * the session.
     * @access public
     * @param string $key
     * @param string $value [optional]
     * @return string|null
     * @since 1.0.1
     */
    public static function session($key, $value = "") {
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
     * Danger: Sets a message or returns the value of the SESSION_FLASH_DANGER key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function danger($value = "") {
        return(self::session(Config::get("SESSION_FLASH_DANGER"), $value));
    }

    /**
     * Info: Sets a message or returns the value of the SESSION_FLASH_INFO key of the
     * session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function info($value = "") {
        return(self::session(Config::get("SESSION_FLASH_INFO"), $value));
    }

    /**
     * Success: Sets a message or returns the value of the SESSION_FLASH_SUCCESS key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function success($value = "") {
        return(self::session(Config::get("SESSION_FLASH_SUCCESS"), $value));
    }

    /**
     * Warning: Sets a message or returns the value of the SESSION_FLASH_WARNING key of
     * the session.
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function warning($value = "") {
        return(self::session(Config::get("SESSION_FLASH_WARNING"), $value));
    }

}
