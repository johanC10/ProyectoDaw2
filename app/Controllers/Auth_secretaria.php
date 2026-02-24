<?php

namespace App\Controllers;

class Auth_secretaria extends BaseController
{
    public function loginSecretaria()
    {
        return view('private/auth/login_gestion'); 
    }

    public function processLoginSecretaria()
    {
        // 1. Recogemos lo que el usuario ha escrito en el formulario
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        // 2. HARDCODE: Comprobamos si es nuestro usuario de prueba
        if ($usuario === 'admin' && $password === '1234') {
            
            // Si es correcto, creamos la sesión "mágica" que pide nuestro Filtro
            session()->set('secretaria_validada', true);
            
            // Y lo enviamos directamente al panel (saltando el paso del código por ahora)
            return redirect()->to('/private/dashboard');
            
        } else {
            // Si falla, lo devolvemos al login con un mensaje de error
            return redirect()->to('/auth/secretaria')->with('error', 'Dades incorrectes. Prova amb usuari: admin / pass: 1234');
        }
    }

    // Estas funciones las dejamos preparadas para el futuro
    public function validarSecretaria()
    {
        return view('private/auth/validar_secretaria');
    }

    public function comprobarCodigo()
    {
        session()->set('secretaria_validada', true);
        return redirect()->to('/private/dashboard');
    }

    public function logout()
    {
        // Al salir, destruimos la sesión para que el Filtro vuelva a bloquear el acceso
        session()->destroy();
        return redirect()->to('/auth/secretaria');
    }
}