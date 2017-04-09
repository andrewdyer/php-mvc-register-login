<?php

namespace App\Presenter;

use App\Core;

/**
 * User Presenter:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.5
 */
class User extends Core\Presenter {

    /**
     * Profile:
     * @access public
     * @return array
     * @since 1.0.5
     */
    public function profile() {
        return [
            "name" => $this->data->forename . " " . $this->data->surname,
            "username" => $this->data->username
        ];
    }

}
