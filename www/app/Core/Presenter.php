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
     * @param string $format [optional]
     * @return string
     * @since 1.0.5
     */
    public function present($format = "") {
        $method = $format ? : DEFAULT_PRESENTER;
        if (method_exists($this, $method)) {
            return((Object) ($this->{$method}()));
        }
    }

}
