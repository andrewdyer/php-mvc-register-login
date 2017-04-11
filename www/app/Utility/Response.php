<?php

namespace App\Utility;

/**
 * Response:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.6
 */
class Response {

    /**
     * JSON: Outputs a JSON encoded string.
     * @access public
     * @param mixed $data
     * @param integer $status [optional]
     * @return void
     * @since 1.0.6
     */
    public static function JSON($data, $status = 200) {
        // Set the headers
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        self::setStatusCode($status);
        // Cast the value of $data to type array if it is not already.
        if (!is_array($data)) {
            $data = (array) $data;
        }
        // Output a JSON encoded string by killing the script here.
        die(json_encode($data));
    }

    /**
     * Set Status Code: Sets the HTTP headers.
     * @access public
     * @param integer $status
     * @return void
     * @since 1.0.6
     */
    public static function setStatusCode($status) {
        $statuses = [
            200 => "OK",
            401 => "Unauthorized",
            403 => "Forbidden",
            400 => "Bad Request",
            404 => "Not Found",
            405 => "Method Not Allowed",
            500 => "Internal Server Error"
        ];
        header("HTTP/1.1 {$status} " . ($statuses[$status] ? $statuses[$status] : $statuses[500]));
    }

}
