<?php declare(strict_types=1);

/**
 * --------------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------------
 *
 * This file is where you define all of your application's routes. It is
 * included by the bootstrapper and should be used to add routes to the
 * $router instance.
 *
 * Example Syntax:
 * $router->get('/users', 'UserController@index');
 * $router->post('/users', 'UserController@store');
 * $router->get() for normal page and data display
 * $router->post() for post form for porcessing isset($_post)
 * $router->any() for both post and get
 * 
 */

// Original Framework Welcome Route Preservation
$router->get('/framework-home', 'HomeController@index');

// --------------------------------------------------------------------------
// Binod Sthapit Personal Profile Routes
// --------------------------------------------------------------------------

// Root Homepage & Profile Home
$router->get('', 'ProfileController@index');
$router->get('index.php', 'ProfileController@index');
$router->get('/profile', 'ProfileController@index');
$router->get('index.php/profile', 'ProfileController@index');

// About
$router->get('/about', 'ProfileController@about');
$router->get('/profile/about', 'ProfileController@about');
$router->get('index.php/profile/about', 'ProfileController@about');

// Services
$router->get('/services', 'ProfileController@services');
$router->get('/profile/services', 'ProfileController@services');
$router->get('index.php/profile/services', 'ProfileController@services');

// Blog Listing
$router->get('/blog', 'ProfileController@blog');
$router->get('/profile/blog', 'ProfileController@blog');
$router->get('index.php/profile/blog', 'ProfileController@blog');

// Single Article Reader
$router->get('/blog/{slug}', 'ProfileController@article');
$router->get('/profile/blog/{slug}', 'ProfileController@article');
$router->get('index.php/profile/blog/{slug}', 'ProfileController@article');

// Contact
$router->get('/contact', 'ProfileController@contact');
$router->get('/profile/contact', 'ProfileController@contact');
$router->get('index.php/profile/contact', 'ProfileController@contact');

// Contact Submission (POST)
$router->post('/contact', 'ProfileController@submitContact');
$router->post('/profile/contact', 'ProfileController@submitContact');
$router->post('index.php/profile/contact', 'ProfileController@submitContact');
