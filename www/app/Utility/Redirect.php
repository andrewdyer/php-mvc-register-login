<?php

namespace App\Utility;

/**
 * Description of Redirect
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Redirect {

    /**
     * To:
     * @access public
     * @param string $location [optional]
     * @return void
     * @since 1.0.1
     */
    public static function to($location = "") {
        if ($location) {
            header('Location: ' . $location);
            exit();
        }
    }

}
