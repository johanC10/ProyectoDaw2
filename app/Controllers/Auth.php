<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function loginEstudiante()
    {
        return view('public/login_estudiante');
    }

    /* mes tard per gestinoar el login
    public function processLoginEstudiante()
    {
        echo "Procesando login...";
    }
    */
}
