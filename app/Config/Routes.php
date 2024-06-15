<?php

use CodeIgniter\Router\RouteCollection;

/*
 * @var RouteCollection $routes
 */

// app/Config/Routes.php

// Home routes
$routes->get('/', 'Home::index');
$routes->get('home/agents', 'Home::agents');
$routes->get('home/properties', 'Home::properties');
$routes->get('home/info', 'Home::info');
$routes->get('home/kpr', 'Home::kpr');

// Auth routes
$routes->get('login', 'Auth::login');
$routes->post('login/admin', 'Auth::loginAdmin'); 
$routes->post('login/agent', 'Auth::loginAgent'); 
$routes->get('logout', 'Auth::logout');
$routes->get('/auth/logout', 'Auth::logout');
$routes->post('/auth/logout', 'Auth::logout');


// Admin routes
$routes->group('admin', function ($routes) {
    $routes->get('index', 'Admin::index');


    //properties
    $routes->get('properties/index', 'Admin::properties');
    $routes->get('properties/create', 'Admin::createProperty');
    $routes->post('properties/store', 'Admin::storeProperty');
    $routes->get('property/(:num)', 'Admin::showProperty/$1');
    $routes->get('properties/edit/(:num)', 'Admin::editProperty/$1');
    $routes->put('properties/update/(:num)', 'Admin::updateProperty/$1');
    $routes->delete('properties/delete/(:num)', 'Admin::deleteProperty/$1');

    
    //agents
    $routes->get('agents/index', 'Admin::agents');
    $routes->get('agents/create', 'Admin::createAgent');
    $routes->post('agents/store', 'Admin::storeAgent');
    $routes->get('agents/(:num)', 'Admin::showAgent/$1');
    $routes->get('agents/edit/(:num)', 'Admin::editAgent/$1');
    $routes->put('agents/update/(:num)', 'Admin::updateAgent/$1');
    $routes->delete('agents/delete/(:num)', 'Admin::deleteAgent/$1');

    //showings
    $routes->get('showings/index', 'Admin::showings');
    $routes->get('showings/create', 'Admin::createShowing');
    $routes->post('showings/store', 'Admin::storeShowing');
    $routes->get('showings/(:num)', 'Admin::showShowing/$1');
    $routes->get('showings/edit/(:num)', 'Admin::editShowing/$1');
    $routes->put('showings/update/(:num)', 'Admin::updateShowing/$1');


    //deals
    $routes->get('deals/index', 'Admin::deals');
    $routes->get('deals/create', 'Admin::createDeal');
    $routes->post('deals/store', 'Admin::storeDeal');
    $routes->get('deals/(:num)', 'Admin::showDeal/$1');
    $routes->get('deals/edit/(:num)', 'Admin::editDeal/$1');
    $routes->put('deals/update/(:num)', 'Admin::updateDeal/$1');
    $routes->delete('deals/delete/(:num)', 'Admin::deleteDeal/$1');

});

// Agent routes
$routes->group('agent', function ($routes) {
    $routes->get('index', 'Agent::index');

        //deals
    $routes->get('deals/index', 'Agent::deals');
    $routes->get('deals/show/(:num)', 'Agent::showDeal/$1');

    //properties
    $routes->get('properties/index', 'Agent::properties');
    $routes->get('properties/create', 'Agent::createProperty');
    $routes->post('properties/store', 'Agent::storeProperty');
    $routes->get('property/(:num)', 'Agent::showProperty/$1');
    $routes->get('properties/edit/(:num)', 'Agent::editProperty/$1');
    $routes->put('properties/update/(:num)', 'Agent::updateProperty/$1');
    $routes->delete('properties/delete/(:num)', 'Agent::deleteProperty/$1');

    //showings
    $routes->get('showings/index', 'Agent::showings');
    $routes->get('showings/create', 'Agent::createShowing');
    $routes->post('showings/store', 'Agent::storeShowing');
    $routes->get('showings/(:num)', 'Agent::showShowing/$1');
    $routes->get('showings/edit/(:num)', 'Agent::editShowing/$1');
    $routes->put('showings/update/(:num)', 'Agent::updateShowing/$1');
    $routes->delete('showings/delete/(:num)', 'Agent::deleteShowing/$1');});





