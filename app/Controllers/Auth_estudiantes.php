<?php

namespace App\Controllers;

class Auth_estudiantes extends BaseController
{
    public function loginEstudiante()
    {
        return view('public/login_estudiante');
    }

    public function processLoginEstudiante()
    {
        // Aquí más adelante generaremos el código
        return redirect()->to('/validar_estudiante');
    }

    public function validarEstudiante()
    {
        return view('public/validar_estudiante');
    }

    public function comprobarCodigo()
    {
        // Aquí validarías el código realmente

        // Simulamos que es correcto:
        session()->set('estudiante_validado', true);

        return redirect()->to('/formulario/paso1');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/estudiante');
    }
}
