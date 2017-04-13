<?php

namespace App\Utility;

/**
 * Response:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.6
 */
class Response {

    /** @var array */
    private $_data = [];

    /**
     * Set Data:
     * @access public
     * @param mixed $data
     * @return \App\Utility\Response
     * @since 1.0.6
     */
    public function setData($data) {
        if (!is_array($data)) {
            $data = (array) $data;
        }
        $this->_data = array_merge($this->_data, $data);
        return $this;
    }

    /**
     * Set Error:
     * @access public
     * @return \App\Utility\Response
     * @since 1.0.6
     */
    public function setError() {
        $this->_data["success"] = false;
        return $this;
    }

    /**
     * Set Status Code:
     * @access public
     * @param integer $status
     * @return \App\Utility\Response
     * @since 1.0.6
     */
    public function setStatusCode($status) {
        $statuses = [
            200 => "OK",
            401 => "Unauthorized",
            403 => "Forbidden",
            400 => "Bad Request",
            404 => "Not Found",
            405 => "Method Not Allowed",
            500 => "Internal Server Error"
        ];
        if (array_key_exists($status, $statuses)) {
            header("HTTP/1.1 {$status} " . $statuses[$status]);
        }
        return $this;
    }

    /**
     * Set Success:
     * @access public
     * @return \App\Utility\Response
     * @since 1.0.6
     */
    public function setSuccess() {
        $this->_data["success"] = true;
        return $this;
    }

    /**
     * Output Json:
     * @access public
     * @return void
     * @since 1.0.6
     */
    public function outputJSON() {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        die(json_encode($this->_data));
    }

    /**
     * Error:
     * @access public
     * @param integer $status
     * @param mixed $data [optional]
     * @return void
     * @since 1.0.6
     */
    public static function error($status, $data = []) {
        $Response = new Response();
        $Response->setError();
        $Response->setData($data);
        $Response->setStatusCode($status);
        $Response->outputJSON();
    }

    /**
     * Success:
     * @access public
     * @param mixed $data [optional]
     * @return void
     * @since 1.0.6
     */
    public static function success($data = []) {
        $Response = new Response();
        $Response->setSuccess();
        $Response->setData($data);
        $Response->setStatusCode(200);
        $Response->outputJSON();
    }

}
