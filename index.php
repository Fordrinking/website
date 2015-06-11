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
Router::any('favorite', '\controllers\home@favorite');
Router::any('recommend', '\controllers\home@recommend');

Router::any('', '\controllers\user\signup@index');
Router::any('signup', '\controllers\user\signup@signup');
Router::any('signup-client', '\controllers\user\signup@signupClient');
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
Router::any('post-message', '\controllers\user\user@postMessage');
Router::any('post-poll', '\controllers\user\user@postPoll');

Router::any('post-blog-client', '\controllers\user\user@postBlogClient');
Router::any('post-photos-client', '\controllers\user\user@postPhotosClient');
Router::any('post-sound-client', '\controllers\user\user@postSoundClient');
Router::any('post-video-client', '\controllers\user\user@postVideoClient');
Router::any('post-message-client', '\controllers\user\user@postMessageClient');
Router::any('post-poll-client', '\controllers\user\user@postPollClient');

Router::any('get-blog-client', '\controllers\home@clientGetBlogs');
Router::any('more-blog', '\controllers\home@moreBlogs');

Router::any('account/info', '\controllers\user\account@info');
Router::any('account/security', '\controllers\user\account@security');
Router::any('account/privacy', '\controllers\user\account@privacy');
Router::any('account/dashboard', '\controllers\user\account@dashboard');

Router::any('account/more-self-blog', '\controllers\user\account@moreSelfBlogs');

Router::any('give-blog-comment', '\controllers\comment@giveBlogComment');

//if no route found
Router::error('\core\error@index');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();
