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
        $credentials = [
            'username' => $this->request->getPost('usuario'),
            'password' => $this->request->getPost('password')
        ];

        // Validamos usando el núcleo inquebrantable de Shield
        if (auth()->attempt($credentials)->isOK()) {
            $user = auth()->user();
            
            session()->set('secretaria_validada', true);
            session()->set('secretaria_id', $user->id);
            // Cogemos el primer grupo que tenga asignado (ej. 'admin' o 'secretaria')
            $groups = $user->getGroups();
            session()->set('secretaria_rol', !empty($groups) ? $groups[0] : 'admin');
            session()->set('secretaria_name', $user->username);
            
            return redirect()->to('/private/dashboard');
        } else {
            return redirect()->to('/auth/secretaria')->with('error', 'Usuari o contrasenya incorrecta');
        }
    }

    public function recoverPassword()
    {
        // En Shield, se mandaría un email oficial aquí. 
        // Recuperamos el input pero respondemos genéricamente.

        // Por seguridad, siempre devolvemos el mismo mensaje, exista o no
        return redirect()->to('/auth/secretaria')->with('success', lang('LoginAdmin.msg_recovery_sent') ?? 'Si estàs donat d\'alta, s\'enviarà un enllaç de recuperació al teu correu associat.');
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
        auth()->logout();
        session()->destroy();
        return redirect()->to('/auth/secretaria');
    }
}