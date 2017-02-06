<?php

namespace App\Utility;

/**
 * Hash:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Hash {

    /**
     * Generate:
     * @access public
     * @param string $string
     * @param string $salt
     * @return string
     * @since 1.0.1
     */
    public static function generate($string, $salt = "") {
        return hash("sha256", $string . $salt);
    }

    /**
     * Generate Salt:
     * @access public
     * @param integer $length
     * @return string
     * @since 1.0.1
     */
    public static function generateSalt($length) {
        $salt = "";
        $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\\][{}\'\";:?.>,<!@#$%^&*()-_=+|";
        for ($i = 0; $i < $length; $i++) {
            $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $salt;
    }

    /**
     * Generate Unique:
     * @access public
     * @return string
     * @since 1.0.1
     */
    public static function generateUnique() {
        return self::generate(uniqid());
    }

}
