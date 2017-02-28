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
     * Generate: Returns a CSRF token and generate a new one if expired.
     * @access public
     * @return string
     * @since 1.0.1
     */
    public static function generate() {
        $maxTime = 60 * 60 * 24;
        $tokenSession = Config::get("SESSION_TOKEN");
        $token = Session::get($tokenSession);
        $tokenTimeSession = Config::get("SESSION_TOKEN_TIME");
        $tokenTime = Session::get($tokenTimeSession);
        if ($maxTime + $tokenTime <= time() or empty($token)) {
            Session::put($tokenSession, md5(uniqid(rand(), true)));
            Session::put($tokenTimeSession, time());
        }
        return Session::get($tokenSession);
    }

    /**
     * Check: Checks if the CSRF token stored in the session is same as in the
     * form submitted.
     * @access public
     * @param string $token
     * @return boolean
     * @since 1.0.1
     */
    public static function check($token) {
        return $token === Session::get(Config::get("SESSION_TOKEN")) and !empty($token);
    }

}
