<?php

namespace App\Core;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use App\Utility\Input;
use App\Utility\Redirect;

/**
 * Core App:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class App {
    
    /** @var mixed The default controller class. */
    private $_class = DEFAULT_CONTROLLER;

    /** @var string The default controller action. */
    private $_method = DEFAULT_CONTROLLER_ACTION;

    /** @var array The parameters passed to the controller. */
    private $_params = [];

    /**
     * Construct: Processes the app by parses the URL and sets the class, class
     * method and method parameters.
     * @access public
     * @since 1.0
     */
    public function __construct() {
        $this->_parseURL();
        try {
            $this->_getClass();
            $this->_getMethod();
            $this->_getParams();
        } catch (Exception $ex) {
            Redirect::to(404);
        }
    }

    /**
     * Get Class: Checks if the first URL element is set and not empty, replacing
     * the default controller class string if the given class exists. If the class
     * exists, said string is replaced with a new instance of it.
     * @access private
     * @return void
     * @since 1.0.6
     * @throws Exception
     */
    private function _getClass() {
        if (isset($this->_params[0]) and ! empty($this->_params[0])) {
            $this->_class = CONTROLLER_PATH . ucfirst(strtolower($this->_params[0]));
            unset($this->_params[0]);
        }
        if (!class_exists($this->_class)) {
            throw new Exception("The controller {$this->_class} does not exist!");
        }
        $this->_class = new $this->_class;
    }

    /**
     * Get Method: Checks if the second URL element is set and not empty,
     * replacing the default controller method string if the given action is a
     * valid class method.
     * @access private
     * @return void
     * @since 1.0.6
     * @throws Exception
     */
    private function _getMethod() {
        if (isset($this->_params[1]) and ! empty($this->_params[1])) {
            $this->_method = $this->_params[1];
            unset($this->_params[1]);
        }

        // Check to ensure the requested controller method exists.
        if (!(new ReflectionClass($this->_class))->hasMethod($this->_method)) {
            throw new Exception("The controller method {$this->_method} does not exist!");
        }

        // Check to ensure the requested controller method is pubic.
        if (!(new ReflectionMethod($this->_class, $this->_method))->isPublic()) {
            throw new Exception("The controller method {$this->_method} is not accessible!");
        }
    }

    /**
     * Get Params: Checks if the URL has any remaining elements, setting the 
     * parameters as a rebase of it if true or an empty array if false.
     * @access private
     * @return void
     * @since 1.0.6
     */
    private function _getParams() {
        $this->_params = $this->_params ? array_values($this->_params) : [];
    }

    /**
     * Parse URL: Gets the different parts of the URL string.
     * @access private
     * @return void
     * @since 1.0
     */
    private function _parseURL() {
        if (($url = Input::get("url"))) {

            // Trim, sanitise and return a exploded URL string.
            $this->_params = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
        }
    }

    /**
     * Run: Calls the controller class and method with parameters.
     * @access private
     * @return void
     * @since 1.0.6
     */
    public function run() {
        call_user_func_array([$this->_class, $this->_method], $this->_params);
    }

}
