<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        // ETAPES
        $this->db->table('etapes')->insertBatch([
            ['nombre' => 'ESO'],
            ['nombre' => 'BATX'],
            ['nombre' => 'FP']
        ]);

        // CURSOS
        $this->db->table('cursos')->insertBatch([
            ['nombre' => 'ESO 1', 'etapa_id' => 1],
            ['nombre' => 'Batxillerat 1', 'etapa_id' => 2],
            ['nombre' => 'DAW2', 'etapa_id' => 3],
        ]);

        // SERVEIS
        $this->db->table('serveis')->insert([
            'nombre' => 'Serveis escolars',
            'precio' => 75
        ]);

        // CURS_SERVEIS
        $this->db->table('curs_serveis')->insert([
            'curso_id' => 3,
            'servei_id' => 1
        ]);

        // TANDES
        $this->db->table('tandes')->insert([
            'nombre' => 'Convocatòria 2025',
            'fecha_inicio' => '2025-06-01',
            'fecha_fin' => '2025-09-01'
        ]);

        // BONIFICACIONS
        $this->db->table('bonificacions')->insertBatch([
            ['nombre' => 'Familia nombrosa', 'importe_descuento' => 50],
            ['nombre' => 'Discapacitat', 'importe_descuento' => 100],
        ]);

        // OPTATIVAS (DAW2 ejemplo)
        $this->db->table('optatives')->insertBatch([
            ['nombre' => 'IA', 'curso_id' => 3],
            ['nombre' => 'Ciberseguretat', 'curso_id' => 3],
            ['nombre' => 'Cloud', 'curso_id' => 3],
            ['nombre' => 'Apps mòbils', 'curso_id' => 3],
        ]);
    }
}
