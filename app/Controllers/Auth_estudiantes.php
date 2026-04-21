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

        // [TODO: Shield Integration]
        // Aquí conectaremos con CodeIgniter Shield para crear las cuentas "invisibles"
        // o buscar al alumno en la tabla 'persones' si ya existe un expediente.
        
        // Simulación: Inyectamos el DNI y Email en la sesión y pasamos a validar código
        session()->setTempdata('temp_estudiante_dni', $dni, 300);
        session()->setTempdata('temp_estudiante_email', $email, 300);

        // En un entorno real se mandaría un email al correo escrito usando el servicio de Mail.
        // Simulamos redirigiendo a la pantalla del OTP
        return redirect()->to('/validar_estudiante')->with('success', 'T\'hem enviat un Codi de 6 digits al teu correu per confirmar la identitat.');
    }

    public function validarEstudiante()
    {
        if (!session()->getTempdata('temp_estudiante_dni')) {
            return redirect()->to('/auth/estudiante')->with('error', 'La sessió de validació ha caducat, siusplau torna a introduir la teva informació.');
        }

        return view('public/validar_estudiante');
    }

    public function comprobarCodigo()
    {
        $codigo = $this->request->getPost('codigo');

        // [TODO: Módulo OTP] Aquí validaremos que el código escrito por el estudiante es real.
        // Para que puedas PROBAR tu Frontend, aceptaremos cualquier código mayor a 3 caracteres.
        
        if (strlen($codigo) >= 3) {
            // Logueo Temporal (Bypass para el filtro de Estudiante que creó tu compañero)
            session()->set('estudiante_validado', true);
            
            // Transferimos el DNI y correo a la sesión del Formulario (wizard)
            $wizard_data = [
                'dni' => session()->getTempdata('temp_estudiante_dni'),
                'email_alumno' => session()->getTempdata('temp_estudiante_email')
            ];
            session()->set('wizard_data', $wizard_data);

            // Redirigir al inicio del asistente!
            return redirect()->to('/formulario/paso1');
        } else {
            return redirect()->back()->with('error', 'El codi introduït és invàlid.');
        }
    }

    public function logout()
    {
        session()->remove('estudiante_validado');
        session()->remove('wizard_data');
        return redirect()->to('/inicio')->with('success', 'Has tancat la sessió de forma segura.');
    }
}
