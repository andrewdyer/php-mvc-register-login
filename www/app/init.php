<?php

require_once "../../vendor/autoload.php";

// Config
define("ROOT", realpath(dirname(__FILE__) . "/../") . "/");

// App Config
define("APP_NAME", "myApp");
define("APP_ROOT", ROOT . "app/");
define("APP_PROTOCOL", stripos($_SERVER["SERVER_PROTOCOL"], "https") === true ? "https://" : "http://");
define("APP_URL", APP_PROTOCOL . $_SERVER["HTTP_HOST"] . str_replace("public_html", "", dirname($_SERVER["SCRIPT_NAME"])) . "/");
define("APP_CONFIG_FILE", APP_ROOT . "config.php");

// Public Config
define("PUBLIC_ROOT", ROOT . "public_html/");

// Controller Config
define("CONTROLLER_PATH", "\App\Controller\\");
define("DEFAULT_CONTROLLER", CONTROLLER_PATH . "Index");
define("DEFAULT_CONTROLLER_ACTION", "index");

// Presenter Config
define("DEFAULT_PRESENTER", "format");

// View Config
define("VIEW_PATH", "../app/View/");
define("DEFAULT_404_PATH", "_template/404.php");
define("DEFAULT_HEADER_PATH", "_template/header");
define("DEFAULT_FOOTER_PATH", "_template/footer");
define("HTMLENTITIES_FLAGS", ENT_QUOTES);
define("HTMLENTITIES_ENCODING", "UTF-8");
define("HTMLENTITIES_DOUBLE_ENCODE", false);
