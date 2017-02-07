<?php

namespace App\Utility;

/**
 * Token:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Token {

    /**
     * Generate:
     * @access public
     * @return string
     * @since 1.0.1
     */
    public static function generate() {
        $maxTime = 60 * 60 * 24;
        $csrfToken = Session::get("CSRF_TOKEN");
        $storedTime = Session::get("CSRF_TOKEN_TIME");
        if ($maxTime + $storedTime <= time() or empty($csrfToken)) {
            Session::put("CSRF_TOKEN", md5(uniqid(rand(), true)));
            Session::put("CSRF_TOKEN_TIME", time());
        }
        return Session::get("CSRF_TOKEN");
    }

    /**
     * Check:
     * @access public
     * @param string $token [optional]
     * @return boolean
     * @since 1.0.1
     */
    public static function check($token = "") {
        if (!$token) {
            $token = Input::post("csrf_token");
        }
        return($token === Session::get("CSRF_TOKEN") and ! empty($token));
    }

}
