<?php

namespace App\Controller;

use App\Core;
use App\Model;

/**
 * Index Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Index extends Core\Controller {

    /**
     * Index:
     * @access public
     * @example index/index
     * @return void
     */
    public function index() {

        // Set any dependencies, data and render the view.
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");
        $this->View->render("index/index", [
            "title" => "Index Controller",
            "songs" => Model\Index::getSongs()
        ]);
    }

}
