<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/auth/estudiante', 'Auth::loginEstudiante');
$routes->post('/login_estudiante', 'Auth::processLoginEstudiante');

$routes->get('/validar_estudiante', 'Auth::validarEstudiante');
$routes->post('/comprobar_codigo', 'Auth::comprobarCodigo');

$routes->post('formulario/guardar_paso1', 'Formulario::guardarPaso1');
$routes->get('/logout', 'Auth::logout');

// Grupo protegido
$routes->group('formulario', ['filter' => 'authEstudiante'], function ($routes) {
    $routes->get('paso1', 'Formulario::paso1');
    $routes->get('paso2', 'Formulario::paso2');
    $routes->get('paso3', 'Formulario::paso3');
    $routes->get('paso4', 'Formulario::paso4');
    $routes->get('paso5', 'Formulario::paso5');
});
