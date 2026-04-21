<?php

namespace App\Controllers;

class Auth_secretaria extends BaseController
{
    public function loginSecretaria()
    {
        
        if (session()->get('secretaria_validada')) {
            return redirect()->to('/private/dashboard');
        }

        
        $this->response->noCache();

        return view('private/auth/login_gestion'); 
    }

    public function processLoginSecretaria()
    {
        
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        
        if ($usuario === 'admin' && $password === '1234') {
            
            session()->set('secretaria_validada', true);
            return redirect()->to('/private/dashboard');
        } else {
            
            return redirect()->to('/auth/secretaria')->with('error', 'Usuari o contrasenya incorrecta');
        }
    }

    
    public function validarSecretaria()
    {
        return view('private/gestion/validacion_detalle');
    }

    public function comprobarCodigo()
    {
        session()->set('secretaria_validada', true);
        return redirect()->to('/private/dashboard');
    }

    public function logout()
    {
        
        session()->destroy();
        return redirect()->to('/auth/secretaria');
    }
}