<?php

namespace App\Controllers;

class Formulario extends BaseController
{
    // Cada método corresponde a un paso del formulario
    //paso 1: datos personales
    public function paso1()
    {
        return view('public/formulario/paso1_datos_personales');
    }

    public function guardarPaso1()
    {
        // De momento guardamos en sesión
        session()->set('paso1', $this->request->getPost());

        return redirect()->to('/formulario/paso2');
    }
    //paso 2: derechos de imagen
    public function paso2()
    {
        return view('public/formulario/paso2_derechos_imagen');
    }

    
    public function paso3()
    {
        return view('public/formulario/paso3_academico_servicios');
    }

    public function paso4()
    {
        return view('public/formulario/paso4_pago_bonificaciones');
    }

    public function paso5()
    {
        return view('public/formulario/paso5_resumen_confirmacion');
    }
}
