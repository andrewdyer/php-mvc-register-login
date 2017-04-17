<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * User Login Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class UserLogin {

    /** @var array The login form inputs. */
    private static $_inputs = [
        "email" => [
            "filter" => "email",
            "required" => true
        ],
        "password" => [
            "required" => true
        ]
    ];

    /**
     * Create Remember Cookie: Inserts a remember-me hash into database and
     * cookie.
     * @access public
     * @param string $userID
     * @return boolean
     * @since 1.0.3
     */
    public static function createRememberCookie($userID) {
        $Db = Utility\Database::getInstance();
        $check = $Db->select("user_cookies", ["user_id", "=", $userID]);
        if ($check->count()) {
            $hash = $check->first()->hash;
        } else {
            $hash = Utility\Hash::generateUnique();
            if (!$Db->insert("user_cookies", ["user_id" => $userID, "hash" => $hash])) {
                return false;
            }
        }
        $cookie = Utility\Config::get("COOKIE_USER");
        $expiry = Utility\Config::get("COOKIE_DEFAULT_EXPIRY");
        return(Utility\Cookie::put($cookie, $hash, $expiry));
    }

    /**
     * Login: Validates the login form inputs, checks the user exists and that
     * the supplied password is correct - writing all necessary data into the
     * session if the login was successful. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     * @throws Exception
     */
    public static function login() {

        // Validate the login form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }

        // Check if the user exists.
        $email = Utility\Input::post("email");
        if (!$User = User::getInstance($email)) {
            Utility\Flash::info(Utility\Text::get("LOGIN_USER_NOT_FOUND"));
            return false;
        }
        try {
            $data = $User->data();

            // Check if the provided password fits the hashed password in the
            // database.
            $password = Utility\Input::post("password");
            if (Utility\Hash::generate($password, $data->salt) !== $data->password) {
                throw new Exception(Utility\Text::get("LOGIN_INVALID_PASSWORD"));
            }

            // Create a remember me cookie if the user has selected the option
            // to remained logged in on the login form.
            $remember = Utility\Input::post("remember") === "on";
            if ($remember and ! self::createRememberCookie($data->id)) {
                //throw new Exception();
            }

            // Write all necessary data into the session as the login has been
            // successful.
            Utility\Session::put(Utility\Config::get("SESSION_USER"), $data->id);
            return true;
        } catch (Exception $ex) {
            Utility\Flash::warning($ex->getMessage());
        }
        return false;
    }

    /**
     * Login With Cookie: Checks if a remember me cookie has been exists and
     * attempts to login the user if the cookie value is found in the database
     * - writing all necessary data into the session if the login was successful.
     * Returns true if everything is okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.3
     */
    public static function loginWithCookie() {

        // Check if a remember me cookie exists.
        if (!Utility\Cookie::exists(Utility\Config::get("COOKIE_USER"))) {
            return false;
        }

        // Check if the hash exists in the database, grabbing the ID of the user
        // it is attached to it if it does.
        $Db = Utility\Database::getInstance();
        $hash = Utility\Cookie::get(Utility\Config::get("COOKIE_USER"));
        $check = $Db->select("user_cookies", ["hash", "=", $hash]);
        if ($check->count()) {

            // Check if the user exists.
            $userID = $Db->first()->user_id;
            if (($User = User::getInstance($userID))) {
                $data = $User->data();
                Utility\Session::put(Utility\Config::get("SESSION_USER"), $data->id);
                return true;
            }
        }
        Utility\Cookie::delete(Utility\Config::get("COOKIE_USER"));
        return false;
    }

    /**
     * Logout: Delete cookie and session. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function logout() {

        // Delete the users remember me cookie if one has been stored.
        $cookie = Utility\Config::get("COOKIE_USER");
        if (Utility\Cookie::exists($cookie)) {
            $Db = Utility\Database::getInstance();
            $hash = Utility\Cookie::get($cookie);
            $check = $Db->delete("user_cookies", ["hash", "=", $hash]);
            if ($check->count()) {
                Utility\Cookie::delete($cookie);
            }
        }

        // Destroy all data registered to the session.
        Utility\Session::destroy();
        return true;
    }

}
