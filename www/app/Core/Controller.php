<?php

namespace App\Core;

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
        $this->View = new View;
    }

}
