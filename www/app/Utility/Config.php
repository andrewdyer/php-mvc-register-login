<?php

namespace App\Utility;

/**
 * Config:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Config {

    /** @var array */
    private static $_config = [];

    /**
     * Get:
     * @access public
     * @param string $key
     * @return mixed
     * @since 1.0.1
     */
    public function get($key) {
        if (empty(self::$_config)) {
            self::$_config = require_once APP_CONFIG_FILE;
        }
        return(array_key_exists($key, self::$_config) ? self::$_config[$key] : "");
    }

}
