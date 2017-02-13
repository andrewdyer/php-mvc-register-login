<?php

namespace App\Utility;

/**
 * Config:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Config {

    /** @var array The contents of the configuration file. */
    private static $_config = [];

    /**
     * Get: Returns the value of a specific key from the application
     * configuration file if it exists, otherwise returns nothing.
     * @access public
     * @param string $key
     * @return mixed
     * @since 1.0.1
     */
    public static function get($key) {
        if (empty(self::$_config)) {
            self::$_config = require_once APP_CONFIG_FILE;
        }
        return(array_key_exists($key, self::$_config) ? self::$_config[$key] : null);
    }

}
