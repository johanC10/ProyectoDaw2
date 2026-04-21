<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    // --- VISTAS PRINCIPALES ---

    // Carga la pantalla principal con todas las etapas
    public function dashboard()
    {
        // Respetando tu ruta exacta
        return view('private/dashboard/dashboard_formaciones');
    }

    // Carga la lista de alumnos de un curso en concreto
    public function listarCurso($id_curso)
    {
        // Le pasamos el ID a la vista para que el botón "Nova Matrícula" sepa a qué curso ir
        $datos['id_curso'] = $id_curso;
        return view('private/gestion/listado_estudiantes_curso', $datos);
    }

    // Carga la Ficha de Validación del alumno
    public function validarMatricula($id_matricula)
    {
        // Ya podemos descomentar esto porque la vista ya la hemos creado
        $datos['id_matricula'] = $id_matricula;
        return view('private/gestion/validacion_detalle', $datos);
    }


    // --- NUEVAS FUNCIONES DE ACCIÓN (Para que no te dé error 404 al pulsar botones) ---

    // Pantalla para crear matrícula a mano desde secretaría
    public function crearMatricula($id_curso)
    {
        echo "Aquesta és la pantalla per crear una Nova Matrícula manualment per al curs ID: " . $id_curso;
    }

    // Procesar los botones de Guardar Notas, Rechazar o Validar (POST)
    public function procesarMatricula($id_matricula)
    {
        $accion = $this->request->getPost('accion');
        echo "S'ha processat l'acció: " . $accion . " per a la matrícula ID: " . $id_matricula;
    }

    // Procesar el envío del correo de corrección desde el Modal (POST)
    public function solicitarCorreccion($id_matricula)
    {
        echo "S'ha enviat el correu de correcció a l'alumne de la matrícula ID: " . $id_matricula;
    }
}