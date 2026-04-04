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

        $usuarioModel = new \App\Models\UsuarioSecretariaModel();
        $user = $usuarioModel->where('usuari', $usuario)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Update last access
            $usuarioModel->update($user['id'], ['data_ultim_acces' => date('Y-m-d H:i:s')]);

            session()->set('secretaria_validada', true);
            session()->set('secretaria_id', $user['id']);
            session()->set('secretaria_rol', $user['rol']);
            session()->set('secretaria_name', $user['usuari']);
            
            return redirect()->to('/private/dashboard');
        } else {
            return redirect()->to('/auth/secretaria')->with('error', 'Usuari o contrasenya incorrecta');
        }
    }

    public function recoverPassword()
    {
        $usuario = $this->request->getPost('recover_user');
        $usuarioModel = new \App\Models\UsuarioSecretariaModel();
        
        $user = $usuarioModel->where('usuari', $usuario)->first();

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
        
        session()->destroy();
        return redirect()->to('/auth/secretaria');
    }
}