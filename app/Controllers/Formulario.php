<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Formulario extends BaseController
{
    // Cada método corresponde a un paso del formulario
    //paso 1: datos personales
    public function paso1()
    {
        $data = [
            'title' => 'Portal - Pas 1',
            'session_data' => $this->session->get('wizard_data') ?? []
        ];
        return view('public/formulario/paso1_datos_personales', $data);
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
        $data = [
            'title' => 'Portal - Pas 2',
            'session_data' => $this->session->get('wizard_data') ?? []
        ];
        return view('public/formulario/paso2_derechos_imagen', $data);
    }

    
    public function paso3()
    {
        // Mock trayendo optativas simuladas
        $optativas = [
            ['id' => 1, 'nom_optativa' => 'Disseny d\'Interfícies Web', 'descripcio' => 'Creació de prototips avançats i maquetació moderna usant CSS grid i figma.'],
            ['id' => 2, 'nom_optativa' => 'Programació Multimedia i Mòbils', 'descripcio' => 'Desenvolupament Android natiu en Kotlin i jocs en 2D usant Unity.'],
            ['id' => 3, 'nom_optativa' => 'Auditoria de Seguretat', 'descripcio' => 'Hacking ètic, xarxes privades VPN i desplegament de tallafocs.'],
            ['id' => 4, 'nom_optativa' => 'Programació ReactJS', 'descripcio' => 'Creació d\'aplicacions web interactives SPA amb llibreries modernes.'],
        ];

        $data = [
            'title' => 'Portal - Pas 3',
            'optativas' => $optativas,
            'session_data' => $this->session->get('wizard_data') ?? []
        ];
        return view('public/formulario/paso3_optativas_y_serveis', $data);
    }

    public function guardarPaso3()
    {
        $wizard_data = $this->session->get('wizard_data') ?? [];
        
        // --- GUARDADO DE OPTATIVAS Y SERVICIOS ---
        foreach ($this->request->getPost() as $key => $value) {
            if (strpos($key, 'optativa') === 0 || in_array($key, ['servei_transport', 'comarca_transporte', 'servei_taquilla', 'tipo_taquilla'])) {
                $wizard_data[$key] = $value;
            }
        }
        
        $doc_transporte = $this->request->getFile('doc_transporte');
        if ($doc_transporte && $doc_transporte->isValid()) {
            $wizard_data['doc_transporte_name'] = $doc_transporte->getName();
        }

        // --- BORRAR DATOS FUTUROS ---
        unset($wizard_data['tipo_matricula'], $wizard_data['tipo_descuento'], $wizard_data['import_total']); // Paso 4

        $this->session->set('wizard_data', $wizard_data);
        return redirect()->to('/formulario/paso4');
    }

    // --- PASO 4 ---
    public function paso4()
    {
        $data = [
            'title' => 'Portal - Pas 4 (Pagament)',
            'precio_base' => 380, 
            'precio_modulo' => 60,
            'precio_serveis' => 75,
            'bonificacions' => [
                ['id' => 1, 'nom_bonificacio' => 'Família Nombrosa (General)', 'import_descompte' => 0.5],
                ['id' => 2, 'nom_bonificacio' => 'Família Nombrosa (Especial)', 'import_descompte' => 1.0],
                ['id' => 3, 'nom_bonificacio' => 'Beca Equitat', 'import_descompte' => 0.3],
            ],
            'session_data' => $this->session->get('wizard_data') ?? []
        ];
        return view('public/formulario/paso4_pagament', $data);
    }

    public function guardarPaso4()
    {
        $wizard_data = $this->session->get('wizard_data') ?? [];
        $wizard_data['tipo_matricula'] = $this->request->getPost('tipo_matricula');
        $wizard_data['tipo_descuento'] = $this->request->getPost('tipo_descuento');
        $wizard_data['tiene_hermanos'] = $this->request->getPost('tiene_hermanos') ?? 'no';
        $wizard_data['import_total'] = $this->request->getPost('import_total');

        $justificante = $this->request->getFile('justificante_pago');
        if ($justificante && $justificante->isValid()) {
            $wizard_data['justificante_pago_name'] = $justificante->getName();
        }

        $this->session->set('wizard_data', $wizard_data);
        return redirect()->to('/formulario/paso5');
    }

    // --- PASO 5 ---
    public function paso5()
    {
        $wizard_data = $this->session->get('wizard_data') ?? [];

        $data = [
            'title' => 'Portal - Pas 5 (Confirmació)',
            'session_data' => $wizard_data
        ];
        return view('public/formulario/paso5_confirmacio', $data); 
    }

    public function finalizar()
    {
        // Aqui se guardaria en base de datos.
        $this->session->remove('wizard_data');
        return redirect()->to('/formulario/exito')->with('success', 'La teva sol·licitud s\'ha processat satistactòriament!');
    }

    public function exito()
    {
        $data = ['title' => 'Portal - Matrícula Completada'];
        return view('public/formulario/exito', $data);
    }
}
