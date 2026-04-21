<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class MainSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. LIMPIAR TABLAS
        $db->query('SET FOREIGN_KEY_CHECKS = 0');
        $db->table('inventari_taquilles')->truncate();
        $db->table('matricules_bonificacions')->truncate();
        $db->table('bonificacions')->truncate();
        $db->table('matricules_serveis')->truncate();
        $db->table('cursos_serveis')->truncate();
        $db->table('serveis')->truncate();
        $db->table('matricules_optatives')->truncate();
        $db->table('matricules')->truncate();
        $db->table('doc_identitat')->truncate();
        $db->table('tutories')->truncate();
        $db->table('persones')->truncate();
        $db->table('pobles')->truncate();
        $db->table('optatives')->truncate();
        $db->table('tandes')->truncate();
        $db->table('cursos')->truncate();
        $db->table('etapes')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS = 1');

        // 2. CREAR USUARIO ADMIN PRINCIPAL (SHIELD)
        $users = new UserModel();
        
        // Limpiar el usuario si ya existiera de un seed anterior
        $existingDb = $users->where('username', 'admin_caparrella')->first();
        if ($existingDb) {
            $users->delete($existingDb->id, true);
        }

        $user = new User([
            'username' => 'admin_caparrella',
            'email'    => 'admin@caparrella.cat',
            'password' => 'secreto123',
        ]);
        $users->save($user);

        // Asignar el grupo de administrador
        $user = $users->findById($users->getInsertID());
        $user->addGroup('admin');

        // 3. SEED DE POBLES (A modo de ejemplo)
        $poblesData = [
            ['nom_poble' => 'Lleida', 'codi_postal' => '25001', 'arxiu_consell_comarcal' => null],
            ['nom_poble' => 'Alpicat', 'codi_postal' => '25110', 'arxiu_consell_comarcal' => 'transport_alpicat.pdf'],
            ['nom_poble' => 'Alcarràs', 'codi_postal' => '25180', 'arxiu_consell_comarcal' => 'transport_alcarras.pdf'],
        ];
        $db->table('pobles')->insertBatch($poblesData);

        // 4. CREAR ETAPAS, CURSOS Y TANDAS (MÍNIMAS PARA PRUEBAS)
        $etapaEsoId = $this->insertarEtapa('E.S.O.', [
            ['nom_curs' => '1r ESO', 'familia_profesional' => 'Educació Secundària Obligatòria'],
            ['nom_curs' => '2n ESO', 'familia_profesional' => 'Educació Secundària Obligatòria'],
            ['nom_curs' => '3r ESO', 'familia_profesional' => 'Educació Secundària Obligatòria'],
            ['nom_curs' => '4t ESO', 'familia_profesional' => 'Educació Secundària Obligatòria'],
        ]);
        
        $etapaBatId = $this->insertarEtapa('Batxillerat', [
            ['nom_curs' => 'Humanitats i ciències socials', 'familia_profesional' => 'Batxillerat'],
            ['nom_curs' => 'Ciències i tecnologia', 'familia_profesional' => 'Batxillerat'],
        ]);
        
        $etapaCfgmId = $this->insertarEtapa('FP de Grau Mitjà', [
            ['nom_curs' => 'CFGM Carrosseria', 'familia_profesional' => 'Transport i Manteniment de Vehicles'],
            ['nom_curs' => 'CFGM Electromecànica de vehicles adaptat a vehicles industrials (camions)', 'familia_profesional' => 'Transport i Manteniment de Vehicles'],
            ['nom_curs' => 'CFGM Electromecànica de vehicles automòbils', 'familia_profesional' => 'Transport i Manteniment de Vehicles'],
            ['nom_curs' => 'CFGM Instal·lacions de Telecomunicacions', 'familia_profesional' => 'Electricitat i Electrònica'],
            ['nom_curs' => 'CFGM Preimpressió digital', 'familia_profesional' => 'Arts Gràfiques'],
            ['nom_curs' => 'CFGM Sistemes Microinformàtics i Xarxes', 'familia_profesional' => 'Informàtica i Comunicacions'],
            ['nom_curs' => 'CFGM Vídeo, discjòquei i so', 'familia_profesional' => 'Imatge i So'],
            ['nom_curs' => 'Conducció De Vehicles De Transport Per Carretera', 'familia_profesional' => 'Transport i Manteniment de Vehicles']
        ]);
        
        $etapaCfgsId = $this->insertarEtapa('FP de Grau Superior', [
            ['nom_curs' => 'CFGS Administració de sistemes informàtics en xarxa', 'familia_profesional' => 'Informàtica i Comunicacions'],
            ['nom_curs' => 'CFGS Administració de sistemes informàtics en xarxa – perfil ciberseguretat', 'familia_profesional' => 'Informàtica i Comunicacions'],
            ['nom_curs' => 'CFGS Automoció', 'familia_profesional' => 'Transport i Manteniment de Vehicles'],
            ['nom_curs' => 'CFGS Desenvolupament d’Aplicacions Multiplataforma', 'familia_profesional' => 'Informàtica i Comunicacions'],
            ['nom_curs' => 'CFGS Desenvolupament d’Aplicacions Web (dual)', 'familia_profesional' => 'Informàtica i Comunicacions'],
            ['nom_curs' => 'CFGS Disseny i edició de publicacions impreses i multimèdia', 'familia_profesional' => 'Arts Gràfiques'],
            ['nom_curs' => 'CFGS Il·luminació, captació i tractament d’imatge', 'familia_profesional' => 'Imatge i So'],
            ['nom_curs' => 'CFGS Manteniment electrònic', 'familia_profesional' => 'Electricitat i Electrònica']
        ]);

        // 5. SERVEIS Y BONIFICACIONS
        $serveis = [
            ['nom_servei' => 'Assegurança escolar', 'preu_servei' => 1.12],
            ['nom_servei' => 'AMPA', 'preu_servei' => 30.00],
        ];
        $db->table('serveis')->insertBatch($serveis);

        $bonificacions = [
            ['nom_bonificacio' => 'Família Nombrosa General', 'import_descompte' => 0.50], // 50% discount
            ['nom_bonificacio' => 'Família Monoparental', 'import_descompte' => 0.50],
        ];
        $db->table('bonificacions')->insertBatch($bonificacions);

        // 6. GENERAR PERSONAS Y MATRICULAS (ALUMNOS RANDOM)
        $faker = \Faker\Factory::create('es_ES');
        // Queremos generar 5 estudiantes por curso
        $todosCursos = $db->table('cursos')->get()->getResultArray();
        $todosTandos = $db->table('tandes')->get()->getResultArray();

        foreach ($todosCursos as $curso) {
            // Find the matching tanda
            $tandaId = null;
            foreach ($todosTandos as $t) {
                if ($t['id_curs'] == $curso['id']) {
                    $tandaId = $t['id'];
                    break;
                }
            }

            for ($i = 0; $i < 5; $i++) {
                // Generar Persona
                $pobleId = rand(1, 3);
                $db->table('persones')->insert([
                    'nom' => $faker->firstName(),
                    'cognom1' => $faker->lastName(),
                    'cognom2' => $faker->lastName(),
                    'identificacio' => $faker->unique()->dni(),
                    'data_naixement' => $faker->dateTimeBetween('-20 years', '-12 years')->format('Y-m-d'),
                    'telefon' => $faker->phoneNumber(),
                    'email' => $faker->unique()->safeEmail(),
                    'adreca' => $faker->streetAddress(),
                    'id_poble' => $pobleId,
                    'tsi' => strtoupper($faker->bothify('????######')),
                    'data_creacio' => date('Y-m-d H:i:s'),
                ]);
                $personaId = $db->insertID();

                // Generar Matrícula Mínima
                $estats = ['pendent', 'validat', 'rebutjat'];
                $tipus_alumne = ['nou', 'continuitat', 'repetidor'];
                $haFirmat = rand(0, 1) ? date('Y-m-d H:i:s') : null;

                $db->table('matricules')->insert([
                    'id_alumne' => $personaId,
                    'id_curs' => $curso['id'],
                    'id_tanda' => $tandaId,
                    'any_academic' => '2026-2027',
                    'estat' => $estats[array_rand($estats)],
                    'tipus_alumne' => $tipus_alumne[array_rand($tipus_alumne)],
                    'data_firma_imatge' => $haFirmat,
                    'import_total' => rand(0, 300),
                    'data_creacio' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }

    private function insertarEtapa($nombreEtapa, $cursos)
    {
        $db = \Config\Database::connect();
        $db->table('etapes')->insert(['nom_etapa' => $nombreEtapa]);
        $etapaId = $db->insertID();

        foreach ($cursos as $c) {
            $db->table('cursos')->insert([
                'id_etapa' => $etapaId,
                'nom_curs' => $c['nom_curs'],
                'familia_profesional' => $c['familia_profesional']
            ]);
            $cursoId = $db->insertID();

            $db->table('tandes')->insert([
                'id_curs' => $cursoId,
                'num_tanda' => 1,
                'data_inici' => '2026-06-01',
                'data_fi' => '2026-06-25'
            ]);
        }

        return $etapaId;
    }
}
