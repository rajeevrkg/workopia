<?php

$router->get('/', 'HomeController@index');
$router->get('/listing', 'ListingController@index');
$router->get('/listing/create', 'ListingController@create');
$router->get('/listing/show', 'ListingController@show');

?>