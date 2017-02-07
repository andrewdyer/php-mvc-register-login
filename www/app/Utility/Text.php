<?php

namespace App\Utility;

/**
 * Text:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Text {

    /** @var array The texts array from the application configuration file. */
    private static $_texts = [];

    /**
     * Get: Returns the value of a specific key from the texts array in the
     * application configuration file if it exists, otherwise an empty string is
     * returned.
     * @access public
     * @param string $key
     * @param array $data [optional]
     * @return string
     * @since 1.0.1
     */
    public static function get($key, array $data = []) {
        if (empty(self::$_texts)) {
            $texts = Config::get("TEXTS");
            self::$_texts = is_array($texts) ? $texts : [];
        }
        if (array_key_exists($key, self::$_texts)) {
            $text = self::$_texts[$key];
            foreach ($data as $search => $replace) {
                $text = str_replace($search, $replace, $text);
            }
            return $text;
        }
        return "";
    }

}
