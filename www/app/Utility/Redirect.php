<?php

namespace App\Utility;

/**
 * Redirect:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.1
 */
class Redirect {

    /**
     * To: Redirects to a specific path.
     * @access public
     * @param string $location [optional]
     * @return void
     * @since 1.0.1
     */
    public static function to($location = "") {
        if ($location) {
            if ($location === 404) {
                header('HTTP/1.0 404 Not Found');
                include VIEW_PATH . DEFAULT_404_PATH;
            } else {
                header("Location: " . $location);
            }
            exit();
        }
    }

}
