<?php namespace core;

/*
 * config - an example for setting up system settings
 * When you are done editing, rename this file to 'Config.php'
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @author Edwin Hoksberg - info@edwinhoksberg.nl
 * @version 2.1
 * @date June 27, 2014
 */
use helpers\Session;

class Config {

    public function __construct() {

        //turn on output buffering
        ob_start();

        //site address
        define('DIR', 'http://example.com/');

        //set default controller and method for legacy calls
        define('DEFAULT_CONTROLLER', 'home');
        define('DEFAULT_METHOD' , 'index');

        //set a default language
        define('LANGUAGE_CODE', 'en');

        //database details ONLY NEEDED IF USING A DATABASE
        define('DB_TYPE', 'mysql');
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'db_name');
        define('DB_USER', 'user');
        define('DB_PASS', 'password');
        define('PREFIX', 'prefix_');

        //set prefix for sessions
        define('SESSION_PREFIX', 'prefix_');

        //optionall create a constant for the name of the site
        define('SITETITLE', 'XXX');

        define('LOCAL_DIR', 'your local path');

        //turn on custom error handling
        set_exception_handler('core\logger::exception_handler');
        set_error_handler('core\logger::error_handler');

        //set timezone
        date_default_timezone_set('Asia/Shanghai');

        //start sessions
        Session::init();

        //set the default template
        Session::set('template', 'default');

        Dao::openDB();
    }

}