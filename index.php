<?php
if(file_exists('vendor/autoload.php')){
	require 'vendor/autoload.php';
} else {
	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
	exit;
}

if (!is_readable('app/core/Config.php')) {
	die('No Config.php found, configure and rename config.example.php to Config.php in app/core.');
}

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;

		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}

}

//initiate config
new \core\Config();

//create alias for Router
use \core\Router,
    \helpers\Url;

//define routes
Router::any('home', '\controllers\home@index');

Router::any('', '\controllers\user\signup@index');
Router::any('signup-check', '\controllers\user\signup@check');
Router::any('signup-check-email', '\controllers\user\signup@checkEmail');
Router::any('signup-check-name', '\controllers\user\signup@checkUsername');

Router::any('test', '\controllers\user\signup@testFun');

Router::any('login', '\controllers\user\auth@login');
Router::any('login-client', '\controllers\user\auth@clientLogin');
Router::any('logout', '\controllers\user\auth@logout');

Router::any('post-blog', '\controllers\user\user@postBlog');
Router::any('post-photos', '\controllers\user\user@postPhotos');
Router::any('post-sound', '\controllers\user\user@postSound');
Router::any('post-video', '\controllers\user\user@postVideo');

Router::any('more-blog', '\controllers\home@moreBlogs');
//if no route found
Router::error('\core\error@index');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();
