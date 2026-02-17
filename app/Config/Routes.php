<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/auth/estudiante', 'Auth::loginEstudiante');
$routes->post('/login_estudiante', 'Auth::processLoginEstudiante');

