<?php

namespace App\Core;

use App\Utility;

/**
 * Core Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Model {

    /** @var Database An instance of the database class. */
    protected $Db = null;

    /**
     * Construct:
     * @access protected
     * @since 1.0.2
     */
    protected function __construct() {
        $this->Db = Utility\Database::getInstance();
    }

}
