<?php

namespace App\Core;

use App\Utility;

/**
 * Core App:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class App {

    /** @var mixed The default controller class. */
    private $_controllerClass = DEFAULT_CONTROLLER;

    /** @var string The default controller action. */
    private $_controllerAction = DEFAULT_CONTROLLER_ACTION;

    /** @var array The parameters passed to the controller. */
    private $_controllerParams = [];

    /**
     * Construct: Analyses the URL elements and calls the according controller
     * and controller action or the fall-back.
     * @access public
     * @since 1.0
     */
    public function __construct() {

        // Get the URL elements.
        $url = $this->_parseUrl();

        // Checks if the first URL element is set / not empty, and replaces the
        // default controller class string if the given class exists.
        if (isset($url[0]) and ! empty($url[0])) {
            $controllerClass = CONTROLLER_PATH . ucfirst(strtolower($url[0]));
            unset($url[0]);
            if (class_exists($controllerClass)) {
                $this->_controllerClass = $controllerClass;
            }
        }

        // Replace the controller class string with a new instance of the it.
        $this->_controllerClass = new $this->_controllerClass;

        // Checks if the second URL element is set / not empty, and replaces the
        // default controller action string if the given action is a valid class
        // method.
        if (isset($url[1]) and ! empty($url[1])) {
            if (method_exists($this->_controllerClass, $url[1])) {
                $this->_controllerAction = $url[1];
                unset($url[1]);
            }
        }

        // Check if the URL has any remaining elements, setting the controller
        // parameters as a rebase of it if true or an empty array if false.
        $this->_controllerParams = $url ? array_values($url) : [];

        // Call the controller and action with parameters.
        call_user_func_array([$this->_controllerClass, $this->_controllerAction], $this->_controllerParams);
    }

    /**
     * Parse Url: Returns the different parts of the URL string.
     * @access private
     * @return array
     * @since 1.0
     */
    private function _parseUrl() {
        if (($url = Utility\Input::get("url"))) {

            // Trim, sanitise and return a exploded URL string.
            return(explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL)));
        }
        return [];
    }

}
