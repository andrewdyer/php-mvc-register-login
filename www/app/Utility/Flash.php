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
     * Message:
     * @access public
     * @param string $key
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function message($key, $value = "") {
        if (Session::exists($key)) {
            $session = Session::get($key);
            Session::delete($key);
            return $session;
        } else {
            return(Session::put($key, $value));
        }
    }

    /**
     * Danger:
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function danger($value = "") {
        return(self::message(Config::get("FLASH_DANGER"), $value));
    }

    /**
     * Info:
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function info($value = "") {
        return(self::message(Config::get("FLASH_INFO"), $value));
    }

    /**
     * Success:
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function success($value = "") {
        return(self::message(Config::get("FLASH_SUCCESS"), $value));
    }

    /**
     * Warning:
     * @access public
     * @param string $value [optional]
     * @return string 
     * @since 1.0.1
     */
    public static function warning($value = "") {
        return(self::message(Config::get("FLASH_WARNING"), $value));
    }

}
