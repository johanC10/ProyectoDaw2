<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    // Carga la pantalla principal con todas las etapas
    public function dashboard()
    {
        return view('private/dashboard_formaciones');
    }

    // Carga la lista de alumnos de un curso en concreto
    // El $id_curso lo recibirá automáticamente de la URL
    public function listarCurso($id_curso)
    {
        // Más adelante aquí harás: $datos['matriculas'] = $modelo->getMatriculasCurso($id_curso);
        
        // Por ahora solo cargamos la vista estática que hicimos
        return view('private/gestion/listado_estudiantes_curso');
    }

    // Preparamos la función para la Ficha de Validación (el siguiente paso que haremos)
    public function validarMatricula($id_matricula)
    {
        // return view('private/gestion/validacion_detalle');
        echo "Aquí irá la ficha de validación de la matrícula ID: " . $id_matricula;
    }
}