<?php

namespace App\Core;

use App\Utility;

/**
 * Core Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Controller {

    /** @var View An instance of the core view class. */
    protected $View = null;

    /**
     * Construct: Creates and stores a new instance of the core view class,
     * which can be accessed by any controller which extends this class.
     * @access public
     * @since 1.0
     */
    public function __construct() {

        // Initialize a session.
        Utility\Session::init();

        // If the user is not logged in but a remember cookie exists then
        // attempt to login with cookie. NOTE: We only do this if we are not on
        // the login with cookie controller method (this avoids creating an
        // infinite loop).
        if (Utility\Input::get("url") !== "login/_loginWithCookie") {
            $cookie = Utility\Config::get("COOKIE_USER");
            $session = Utility\Config::get("SESSION_USER");
            if (!Utility\Session::exists($session) and Utility\Cookie::exists($cookie)) {
                Utility\Redirect::to(APP_URL . "login/_loginWithCookie");
            }
        }

        // Create a new instance of the core view class.
        $this->View = new View;
    }

    /**
     * JSON Response: Outputs a JSON encoded string.
     * @access protected
     * @param mixed $data
     * @param integer $status [optional]
     * @return void
     * @since 1.0.3
     */
    protected function JSONresponse($data, $status = 200) {
        
        // Cast the value of $data to type array if it is not already.
        if (!is_array($data)) {
            $data = (array) $data;
        }
        $statuses = [
            200 => "OK",
            403 => "Forbidden",
            400 => "Bad Request",
            404 => "Not Found",
            405 => "Method Not Allowed",
            500 => "Internal Server Error"
        ];
        
        // Set the headers.
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("HTTP/1.1 {$status} " . ($statuses[$status] ? $statuses[$status] : $statuses[500]));
        header("Content-Type: application/json");
        
        // We return a JSON encoded string and kill the script here.
        die(json_encode($data));
    }

}
