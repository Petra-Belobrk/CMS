<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


define("HTTP_PATH_ROOT",
  isset($_SERVER["HTTP_HOST"]) ?
    $_SERVER["HTTP_HOST"] : (
  isset($_SERVER["SERVER_NAME"]) ?
    $_SERVER["SERVER_NAME"] : '_UNKNOWN_'));
define("LOCAL_PATH_ROOT", $_SERVER["DOCUMENT_ROOT"]); // /app/
define("RELATIVE_PATH_ROOT", '');

define("RELATIVE_PATH_BASE",
  str_replace(LOCAL_PATH_ROOT, RELATIVE_PATH_ROOT, getcwd())); //admin/includes
define("RELATIVE_PATH_APP", dirname(RELATIVE_PATH_BASE)); //admin


  define("HTTP_PATH_BASE", HTTP_PATH_ROOT . RELATIVE_PATH_BASE); //localhost/admin/includes
  define("HTTP_PATH_APP", HTTP_PATH_ROOT . RELATIVE_PATH_APP); //localhost/admin

define("LOCAL_PATH_APP", LOCAL_PATH_ROOT . RELATIVE_PATH_APP); // /admin
define("LOCAL_PATH_BASE", LOCAL_PATH_ROOT . RELATIVE_PATH_BASE);




ob_start();

require_once (LOCAL_PATH_ROOT.DS.'admin'.DS."functions.php");
require_once (LOCAL_PATH_ROOT.DS.'includes'.DS."db.php");


//echo LOCAL_PATH_ROOT;