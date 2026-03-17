<?php

namespace App\Controllers;

class IdiomaController extends BaseController
{
    public function cambiar($locale)
    {
        $session = session();
        
        $idiomasPermitidos = ['ca', 'es', 'en'];
        
        if (in_array($locale, $idiomasPermitidos)) {
            $session->set('idioma', $locale);
        }
        
        return redirect()->back();
    }
}