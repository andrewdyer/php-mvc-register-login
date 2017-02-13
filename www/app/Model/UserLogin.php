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
     * Login: Validates the login form inputs, checks the user exists and that
     * the supplied password is correct - writing all necessary data into the
     * session if the login was successful. Returns true if everything is okay,
     * otherwise turns false.
     * @access public
     * @param string $email
     * @param string $password
     * @return boolean
     * @since 1.0.2
     * @throws Exception
     */
    public static function login($email, $password) {

        // Validate the login form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }

        // Check if the user exists.
        if (!$User = User::getInstance($email)) {
            Utility\Flash::info(Utility\Text::get("LOGIN_USER_NOT_FOUND"));
            return false;
        }
        try {
            $data = $User->data();

            // Check if the provided password fits the hashed password in the
            // database.
            if (Utility\Hash::generate($password, $data->salt) !== $data->password) {
                throw new Exception(Utility\Text::get("LOGIN_INVALID_PASSWORD"));
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
            Utility\Cookie::delete($cookie);
        }

        // Destroy all data registered to the session.
        Utility\Session::destroy();
        return true;
    }

}
