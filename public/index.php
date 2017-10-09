<?php
set_time_limit(6000);
ini_set('memory_limit', '2048M');
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 'on');
//ini_set('max_execution_time', 600);
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Define database environment
defined('DB_HOST')
    || define('DB_HOST', (getenv('DB_HOST') ? getenv('DB_HOST') : 'db'));
defined('DB_USERNAME')
    || define('DB_USERNAME', (getenv('DB_USERNAME') ? getenv('DB_USERNAME') : 'projeto_incluir_user'));
defined('DB_PASSWORD')
    || define('DB_PASSWORD', (getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'projeto_incluir_pw'));
defined('DB_NAME')
    || define('DB_NAME', (getenv('DB_NAME') ? getenv('DB_NAME') : 'projeto_incluir_db'));


// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();
