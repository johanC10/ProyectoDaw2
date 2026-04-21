<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    // --- VISTAS PRINCIPALES ---

    // Carga la pantalla principal con todas las etapas
    // Carga la pantalla principal con todas las etapas
    public function dashboard()
    {
        $etapaModel = new \App\Models\EtapaModel();
        $cursoModel = new \App\Models\CursoModel();
        $matriculaModel = new \App\Models\MatriculaModel();

        // Obtener todas las etapas
        $etapasDb = $etapaModel->findAll();
        
        $etapas = [];
        foreach ($etapasDb as $e) {
            // Obtener cursos de esta etapa
            $cursosDb = $cursoModel->where('id_etapa', $e['id'])->findAll();
            $cursosData = [];
            
            foreach ($cursosDb as $c) {
                // Contar alumnos totales y pendientes
                $totalAlumnos = $matriculaModel->where('id_curs', $c['id'])->countAllResults();
                $pendientes = $matriculaModel->where('id_curs', $c['id'])
                                             ->where('estat', 'pendent')
                                             ->countAllResults();
                
                $cursosData[] = [
                    'id'            => $c['id'],
                    'clave_nombre'  => $c['nom_curs'], 
                    'familia_clave' => $c['familia_profesional'],
                    'alumnos'       => $totalAlumnos,
                    'pendientes'    => $pendientes
                ];
            }
            
            $etapas[] = [
                'clave'       => $e['nom_etapa'], // nom_etapa isn't mapped to language anymore probably, but lets use it logic.
                'icono'       => 'bi-folder', // Generic fallback
                'badge_clave' => 'badge_multiples',
                'cursos'      => $cursosData
            ];
        }

        // Obtener estadisticas generales
        $totalGeneral = $matriculaModel->countAllResults();
        $pendientesGeneral = $matriculaModel->where('estat', 'pendent')->countAllResults();
        $validadasGeneral = $matriculaModel->where('estat', 'validat')->countAllResults();

        $data = [
            'etapas' => $etapas,
            'stats'  => [
                'total'      => $totalGeneral,
                'pendientes' => $pendientesGeneral,
                'validadas'  => $validadasGeneral
            ]
        ];

        return view('private/dashboard/dashboard_formaciones', $data);
    }

    // Carga la lista de alumnos de un curso en concreto
    public function listarCurso($id_curso)
    {
        $matriculaModel = new \App\Models\MatriculaModel();
        $personaModel = new \App\Models\PersonaModel();
        $cursoModel = new \App\Models\CursoModel();
        
        $curso = $cursoModel->find($id_curso);

        // Recuperamos los parámetros GET
        $q = $this->request->getGet('q');
        $estatFilter = $this->request->getGet('estat');
        $dataFilter = $this->request->getGet('data');

        // Empezamos la query
        $builder = $matriculaModel->where('id_curs', $id_curso);

        // Filtro por Estado (convertimos de la vista a la DB)
        if (!empty($estatFilter)) {
            $dbEstat = 'pendent';
            if ($estatFilter === 'validat') $dbEstat = 'validat';
            if ($estatFilter === 'rebutjat') $dbEstat = 'rebutjat';
            $builder->where('estat', $dbEstat);
        }

        // Filtro por Fecha
        if (!empty($dataFilter)) {
            $builder->like('data_creacio', $dataFilter, 'after');
        }

        $matriculasDb = $builder->orderBy('data_creacio', 'DESC')->findAll();
        
        $alumnos = [];
        foreach ($matriculasDb as $m) {
            $estudiante = $personaModel->find($m['id_alumne']);

            // Si hay búsqueda por texto (nombre, apellidos o DNI)
            if (!empty($q)) {
                $qLower = strtolower($q);
                $matchDni = strpos(strtolower($estudiante['identificacio']), $qLower) !== false;
                $matchNombre = strpos(strtolower($estudiante['nom']), $qLower) !== false;
                $matchApellidos = strpos(strtolower($estudiante['cognom1'].' '.$estudiante['cognom2']), $qLower) !== false;
                
                if (!$matchDni && (!$matchNombre && !$matchApellidos)) {
                    continue; // Saltar si no coincide
                }
            }
            
            $estat = $m['estat'];

            $fecha = date('d/m/Y', strtotime($m['data_creacio']));
            $numMatricula = '#MAT-' . date('Y', strtotime($m['data_creacio'])) . '-' . str_pad($m['id'], 4, '0', STR_PAD_LEFT);

            $tieneDocs = true;

            $alumnos[] = [
                'id_matricula'  => $m['id'],
                'dni'           => $estudiante['identificacio'],
                'num_matricula' => $numMatricula,
                'nombre'        => $estudiante['cognom1'] . ' ' . $estudiante['cognom2'] . ', ' . $estudiante['nom'],
                'email'         => $estudiante['email'],
                'fecha'         => $fecha,
                'estat'         => $estat,
                'docs'          => [
                    'dni'      => $tieneDocs, 
                    'tsi'      => $tieneDocs, 
                    'pagament' => $tieneDocs // para simular
                ]
            ];
        }

        // Le pasamos el ID, el objeto curso y los alumnos a la vista
        $datos = [
            'id_curso' => $id_curso,
            'curso'    => $curso,
            'alumnos'  => $alumnos
        ];
        
        return view('private/gestion/listado_estudiantes_curso', $datos);
    }

    // Carga la Ficha de Validación del alumno
    public function validarMatricula($id_matricula)
    {
        $matriculaModel = new \App\Models\MatriculaModel();
        $personaModel = new \App\Models\PersonaModel();
        $cursoModel = new \App\Models\CursoModel();

        $matricula = $matriculaModel->find($id_matricula);
        if (!$matricula) {
            return redirect()->to('/private/dashboard')->with('error', 'Matrícula no encontrada.');
        }

        $estudiante = $personaModel->find($matricula['id_alumne']);
        $curso = $cursoModel->find($matricula['id_curs']);

        $fecha = date('d/n/Y', strtotime($matricula['data_creacio']));

        $datos = [
            'matricula'   => $matricula,
            'estudiante'  => $estudiante,
            'curso'       => $curso,
            'fecha'       => $fecha
        ];

        return view('private/gestion/validacion_detalle', $datos);
    }


    // --- NUEVAS FUNCIONES DE ACCIÓN (Para que no te dé error 404 al pulsar botones) ---

    // Pantalla para crear matrícula a mano desde secretaría
    public function crearMatricula($id_curso)
    {
        echo "Aquesta és la pantalla per crear una Nova Matrícula manualment per al curs ID: " . $id_curso;
    }

    // Procesar los botones de Guardar Notas, Rechazar o Validar (POST)
    public function procesarMatricula($id_matricula)
    {
        if (!$this->request->is('post')) {
            return redirect()->to('/private/dashboard');
        }

        $matriculaModel = new \App\Models\MatriculaModel();
        
        $accion = $this->request->getPost('accion');
        $notas  = $this->request->getPost('notas');

        $dataUpdate = ['notes_admin' => $notas];

        if ($accion === 'validar') {
            $dataUpdate['estat'] = 'validat';
            $mensaje = lang('FichaValidacion.msg_validada_ok', [], service('request')->getLocale()) ?? 'Matrícula validada con éxito.';
        } elseif ($accion === 'rechazar') {
            $dataUpdate['estat'] = 'rebutjat';
            $mensaje = lang('FichaValidacion.msg_rechazada_ok', [], service('request')->getLocale()) ?? 'Matrícula rechazada.';
        } else {
            // Acción: guardar (notas)
            $mensaje = lang('FichaValidacion.msg_notas_ok', [], service('request')->getLocale()) ?? 'Notas internas guardadas correctamente.';
        }

        // Actualizar en base de datos
        $matriculaModel->update($id_matricula, $dataUpdate);

        // PRG: Post-Redirect-Get
        return redirect()->to('/private/validacion/' . $id_matricula)->with('success', $mensaje);
    }

    // Procesar el envío del correo de corrección desde el Modal (POST)
    public function solicitarCorreccion($id_matricula)
    {
        if (!$this->request->is('post')) {
            return redirect()->to('/private/dashboard');
        }

        $matriculaModel = new \App\Models\MatriculaModel();
        $personaModel = new \App\Models\PersonaModel();

        $matricula = $matriculaModel->find($id_matricula);
        if (!$matricula) {
            return redirect()->to('/private/dashboard')->with('error', 'Matrícula no encontrada.');
        }

        $estudiante = $personaModel->find($matricula['id_alumne']);
        
        $mensajeTxt = $this->request->getPost('mensaje');
        $adjunto = $this->request->getFile('archivo_adjunto');

        // Aquí iría la lógica real de envío de Email usando CodeIgniter: ...

        // Marcamos la matrícula de vuelta a pendiente
        $matriculaModel->update($id_matricula, ['estat' => 'pendent']);

        $exitoMsg = lang('FichaValidacion.msg_correo_ok', [], service('request')->getLocale()) ?? 'Correo de corrección enviado a ' . $estudiante['email'];

        // PRG: Post-Redirect-Get
        return redirect()->to('/private/validacion/' . $id_matricula)->with('success', $exitoMsg);
    }

    // --- NUEVO: GESTIÓN DE PAPELERA --- //

    // Archivar/Eliminar suavemente una matrícula
    public function archivarMatricula($id_matricula)
    {
        $matriculaModel = new \App\Models\MatriculaModel();
        $matricula = $matriculaModel->find($id_matricula);
        
        if ($matricula) {
            $matriculaModel->delete($id_matricula); // Soft Delete
            return redirect()->back()->with('success', 'Matrícula movida a la papelera.');
        }

        return redirect()->back()->with('error', 'Error al archivar la matrícula.');
    }

    // Restaurar matrícula desde la papelera
    public function restaurarMatricula($id_matricula)
    {
        $matriculaModel = new \App\Models\MatriculaModel();
        // Nullify the deleted_at date explicitly ignoring softDeletes
        $matriculaModel->builder()->where('id', $id_matricula)->update(['deleted_at' => null]);
        
        return redirect()->back()->with('success', 'Matrícula restaurada con éxito.');
    }

    // Vista de la Papelera
    public function papelera()
    {
        $matriculaModel = new \App\Models\MatriculaModel();
        $personaModel = new \App\Models\PersonaModel();
        $cursoModel = new \App\Models\CursoModel();

        // Recuperamos solo las matrículas borradas (deleted_at is not null)
        $matriculasDb = $matriculaModel->onlyDeleted()->orderBy('deleted_at', 'DESC')->findAll();
        
        $alumnos = [];
        foreach ($matriculasDb as $m) {
            $estudiante = $personaModel->find($m['id_alumne']);
            $curso = $cursoModel->find($m['id_curs']);
            
            $estat = $m['estat'];

            $numMatricula = '#MAT-' . date('Y', strtotime($m['data_creacio'])) . '-' . str_pad($m['id'], 4, '0', STR_PAD_LEFT);

            $langKey = 'Cursos.' . $curso['nom_curs'];
            $translate = lang($langKey);
            $cursoRealName = ($translate === $langKey) ? ucfirst(str_replace('_', ' ', $curso['nom_curs'])) : $translate;

            $alumnos[] = [
                'id_matricula'   => $m['id'],
                'dni'            => $estudiante['identificacio'],
                'num_matricula'  => $numMatricula,
                'nombre'         => $estudiante['cognom1'] . ' ' . $estudiante['cognom2'] . ', ' . $estudiante['nom'],
                'curso_nombre'   => $cursoRealName,
                'fecha_borrado'  => date('d/m/Y H:i', strtotime($m['deleted_at'])),
                'estat'          => $estat
            ];
        }

        $datos = [
            'alumnos'  => $alumnos
        ];
        
        return view('private/gestion/papelera', $datos);
    }
}