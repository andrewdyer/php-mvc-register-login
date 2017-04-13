<?php

namespace App\Core;

/**
 * Core Presenter:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.5
 */
class Presenter {

    /** @var object */
    protected $data = null;

    /**
     * Construct:
     * @access public
     * @param mixed $data
     * @since 1.0.5
     */
    public function __construct($data = []) {
        $this->data = (Object) $data;
    }

    /**
     * Present:
     * @access public
     * @return string
     * @since 1.0.5
     */
    public function present() {
        return((Object) $this->format());
    }

}
