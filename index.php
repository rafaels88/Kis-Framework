<?php
ini_set('error_reporting', E_ALL);
ini_set("display_errors",1);

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH",       realpath('.'). DS);
define("LIB_PATH",        realpath('.'). DS. "lib". DS);
define("CONFIG_PATH",     realpath('.'). DS. "config". DS);
define("DB_PATH",         realpath('.'). DS. "db". DS);
define("CONTROLLER_PATH", realpath('.'). DS. "controller". DS);
define("MODEL_PATH",      realpath('.'). DS. "model". DS);
define("PUBLIC_PATH",     realpath('.'). DS. "public". DS);
define("CSS_PATH",        realpath('.'). DS. "public". DS . "css" . DS);
define("JS_PATH",         realpath('.'). DS. "public". DS . "js" . DS);
define("IMG_PATH",        realpath('.'). DS. "public". DS . "img" . DS);
define("VIEW_PATH",       realpath('.'). DS. "view". DS);

set_include_path(get_include_path(). PATH_SEPARATOR . ROOT_PATH);
set_include_path(get_include_path(). PATH_SEPARATOR . LIB_PATH);
set_include_path(get_include_path(). PATH_SEPARATOR . MODEL_PATH);
set_include_path(get_include_path(). PATH_SEPARATOR . CONTROLLER_PATH);

require_once LIB_PATH . "YamlInterface.php";
require_once LIB_PATH . 'yaml' . DIRECTORY_SEPARATOR . 'sfYamlParser.php';

$Application = Application::getInstance();

$Application->run();

function __autoload($class_name) {
    require_once $class_name.".class.php";
}

?>
