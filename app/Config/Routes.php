<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::inicio');

$routes->get('lang/(:segment)', 'IdiomaController::cambiar/$1');

// --- Estudiantes ---
$routes->get('/auth/estudiante', 'Auth_estudiantes::loginEstudiante');
$routes->post('/login_estudiante', 'Auth_estudiantes::processLoginEstudiante');
$routes->get('/validar_estudiante', 'Auth_estudiantes::validarEstudiante');
$routes->post('/comprobar_codigo', 'Auth_estudiantes::comprobarCodigo');
$routes->get('/logout', 'Auth_estudiantes::logout');

// --- Secretaria ---
$routes->get('/auth/secretaria', 'Auth_secretaria::loginSecretaria');
$routes->post('/process_login_secretaria', 'Auth_secretaria::processLoginSecretaria');
$routes->post('/recover_password_secretaria', 'Auth_secretaria::recoverPassword');
$routes->get('/validar_secretaria', 'Auth_secretaria::validarSecretaria');
$routes->get('/logout_secretaria', 'Auth_secretaria::logout');

// --- Grupo protegido (Formulario) ---
$routes->group('formulario', ['filter' => 'authEstudiante'], function ($routes) {
    // Vistas
    $routes->get('paso1', 'Formulario::paso1');
    $routes->get('paso2', 'Formulario::paso2');
    $routes->get('paso3', 'Formulario::paso3');
    $routes->get('paso4', 'Formulario::paso4');
    $routes->get('paso5', 'Formulario::paso5');
    $routes->get('exito', 'Formulario::exito');

    // Procesadores de datos
    $routes->post('guardarPaso1', 'Formulario::guardarPaso1');
    $routes->post('guardarPaso2', 'Formulario::guardarPaso2');
    $routes->post('guardarPaso3', 'Formulario::guardarPaso3');
    $routes->post('guardarPaso4', 'Formulario::guardarPaso4');
    $routes->post('finalizar', 'Formulario::finalizar');
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

    // --- GESTIÓN DE PAPELERA ---
    $routes->get('papelera', 'AdminController::papelera');
    $routes->get('matricula/archivar/(:num)', 'AdminController::archivarMatricula/$1');
    $routes->post('matricula/restaurar/(:num)', 'AdminController::restaurarMatricula/$1');

});