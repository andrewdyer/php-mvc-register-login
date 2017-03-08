<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Login Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Login extends Core\Controller {

    /**
     * Index: Renders the login view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example login/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated();

        // Set any dependencies, data and render the view.
        $this->View->render("login/index", [
            "title" => "Login"
        ]);
    }

    /**
     * Login: Processes a login request. NOTE: This controller can only be
     * accessed by unauthenticated users!
     * @access public
     * @example login/_login
     * @return void
     * @since 1.0.2
     */
    public function _login() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated();

        // Process the login request, redirecting to the home controller if
        // successful or back to the login controller if not.
        if (Model\UserLogin::login()) {
            Utility\Redirect::to(APP_URL);
        }
        Utility\Redirect::to(APP_URL . "login");
    }

    /**
     * Login With Cookie: Processes a login with cookie request. NOTE: This
     * controller can only be accessed by unauthenticated users!
     * @access public
     * @example login/_loginWithCookie
     * @return void
     * @since 1.0.3
     */
    public function _loginWithCookie() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated();

        // Process the login with cookie request, redirecting to the home
        // controller if successful or back to the login controller if not.
        if (Model\UserLogin::loginWithCookie()) {
            Utility\Redirect::to(APP_URL);
        }
        Utility\Redirect::to(APP_URL . "login");
    }

    /**
     * Logout: Processes a logout request. NOTE: This controller can only be
     * accessed by authenticated users!
     * @access public
     * @example login/logout
     * @return void
     * @since 1.0.2
     */
    public function logout() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Process the logout request, redirecting to the login controller if
        // successful or to the default controller if not.
        if (Model\UserLogin::logout()) {
            Utility\Redirect::to(APP_URL . "login");
        }
        Utility\Redirect::to(APP_URL);
    }

}
