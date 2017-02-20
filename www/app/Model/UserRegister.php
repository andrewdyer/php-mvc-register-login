<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * User Register Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class UserRegister {

    /** @var array The register form inputs. */
    private static $_inputs = [
        "forename" => [
            "required" => true
        ],
        "surname" => [
            "required" => true
        ],
        "email" => [
            "filter" => "email",
            "required" => true,
            "unique" => "users"
        ],
        "password" => [
            "min_characters" => 6,
            "required" => true
        ],
        "password_repeat" => [
            "matches" => "password",
            "required" => true
        ],
    ];

    /**
     * Register: Validates the register form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function register() {

        // Validate the register form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }
        try {

            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Utility\Hash::generateSalt(32);

            // Insert the new user record into the database, storing the unique
            // ID which will be returned on success.
            $User = new User;
            $userID = $User->createUser([
                "email" => Utility\Input::post("email"),
                "forename" => Utility\Input::post("forename"),
                "password" => Utility\Hash::generate(Utility\Input::post("password"), $salt),
                "salt" => $salt,
                "surname" => Utility\Input::post("surname")
            ]);

            // Write all necessary data into the session as the user has been
            // successfully registered and return the user's unique ID.
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
            return $userID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
        }
        return false;
    }

}
