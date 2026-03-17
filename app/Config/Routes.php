<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// --- Estudiantes ---
$routes->get('/auth/estudiante', 'Auth_estudiantes::loginEstudiante');
$routes->post('/login_estudiante', 'Auth_estudiantes::processLoginEstudiante');
$routes->get('/validar_estudiante', 'Auth_estudiantes::validarEstudiante');
$routes->post('/comprobar_codigo', 'Auth_estudiantes::comprobarCodigo');
$routes->get('/logout', 'Auth_estudiantes::logout');

// --- Secretaria ---
$routes->get('/auth/secretaria', 'Auth_secretaria::loginSecretaria');
$routes->post('/process_login_secretaria', 'Auth_secretaria::processLoginSecretaria');
$routes->get('/validar_secretaria', 'Auth_secretaria::validarSecretaria');
$routes->get('/logout_secretaria', 'Auth_secretaria::logout');

// --- Grupo protegido (Formulario) ---
$routes->group('formulario', ['filter' => 'authEstudiante'], function ($routes) {
    $routes->get('paso1', 'Formulario::paso1');
    $routes->get('paso2', 'Formulario::paso2');
    $routes->get('paso3', 'Formulario::paso3');
    $routes->get('paso4', 'Formulario::paso4');
    $routes->get('paso5', 'Formulario::paso5');
});

// --- GRUPO PROTEGIDO DE SECRETARÍA ---
$routes->group('private', ['filter' => 'authSecretaria'], function ($routes) {
    
    // 1. VISTAS PRINCIPALES (Navegación)
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('curso/(:num)', 'AdminController::listarCurso/$1');
    $routes->get('validacion/(:num)', 'AdminController::validarMatricula/$1');
    
    // 2. NUEVA MATRÍCULA (El botón de arriba a la derecha en el listado)
    $routes->get('matricula/crear/(:num)', 'AdminController::crearMatricula/$1');
    
    // 3. PROCESAMIENTO DE DATOS (Cuando Secretaría pulsa botones de acción)
    
    // Para el formulario de "Guardar Notas", "Rechazar" o "Validar"
    $routes->post('procesar_matricula/(:num)', 'AdminController::procesarMatricula/$1');
    
    // Para el formulario del Modal de "Solicitar Corrección"
    $routes->post('solicitar_correccion/(:num)', 'AdminController::solicitarCorreccion/$1');



    $routes->get('lang/(:segment)', 'IdiomaController::cambiar/$1');
});