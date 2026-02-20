<?php

namespace App\Controllers;

class Formulario extends BaseController
{
    public function paso1()
    {
        return view('public/formulario/paso1_datos_personales');
    }

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
