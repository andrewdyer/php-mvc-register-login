<?php

namespace App\Utility;

/**
 * Text:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Text {

    /** @var array */
    private static $_texts = [];

    /**
     * Get:
     * @access public
     * @param string $key
     * @return string
     * @since 1.0.1
     */
    public static function get($key) {
        if (empty(self::$_texts)) {
            $texts = Config::get("TEXTS");
            self::$_texts = is_array($texts) ? $texts : [];
        }
        return(array_key_exists($key, self::$_texts) ? self::$_texts[$key] : "");
    }

}
