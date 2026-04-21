<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth_estudiantes extends BaseController
{
    public function loginEstudiante()
    {
        return view('public/login_estudiante');
    }

    public function processLoginEstudiante()
    {
        $dni = $this->request->getPost('dni');
        $email = $this->request->getPost('email');

        // 🔹 Aquí más adelante validaremos contra base de datos
        if (empty($dni) || empty($email)) {
            return redirect()->back()->with('error', 'Debes rellenar todos los campos');
        }

        // Guardamos datos temporales en sesión
        session()->set('dni_temp', $dni);
        session()->set('email_temp', $email);

        return redirect()->to('/validar_estudiante');
    }

    public function validarEstudiante()
    {
        // Si no pasó por login, no puede entrar
        if (!session()->get('dni_temp')) {
            return redirect()->to('/auth/estudiante');
        }

        return view('public/validar_estudiante');
    }

    public function comprobarCodigo()
    {
        $codigo = $this->request->getPost('codigo');

        if (empty($codigo)) {
            return redirect()->back()->with('error', 'Introduce el código');
        }

        // 🔹 De momento cualquier código es válido
        session()->set('estudiante_validado', true);

        // Limpiamos temporales
        session()->remove(['dni_temp', 'email_temp']);

        return redirect()->to('/formulario/paso1');
    }

    public function logout()
    {
        session()->remove('estudiante_validado');
        session()->remove('wizard_data');
        return redirect()->to('/inicio')->with('success', 'Has tancat la sessió de forma segura.');
    }
}