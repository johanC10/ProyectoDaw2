<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CaparrellaSchema extends Migration
{
    public function up()
    {
        // 1. usuaris_secretaria
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'usuari' => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'rol' => ['type' => 'VARCHAR', 'constraint' => '50'], // admin, direccio, secretaria
            'data_ultim_acces' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuaris_secretaria', true);

        // 2. etapes
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom_etapa' => ['type' => 'VARCHAR', 'constraint' => '100'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('etapes', true);

        // 3. cursos
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_etapa' => ['type' => 'INT', 'unsigned' => true],
            'nom_curs' => ['type' => 'VARCHAR', 'constraint' => '200'],
            'familia_profesional' => ['type' => 'VARCHAR', 'constraint' => '200', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_etapa', 'etapes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cursos', true);

        // 4. tandes
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_curs' => ['type' => 'INT', 'unsigned' => true],
            'num_tanda' => ['type' => 'INT'],
            'data_inici' => ['type' => 'DATE'],
            'data_fi' => ['type' => 'DATE'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_curs', 'cursos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tandes', true);

        // 5. optatives
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_curs' => ['type' => 'INT', 'unsigned' => true],
            'nom_optativa' => ['type' => 'VARCHAR', 'constraint' => '200'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_curs', 'cursos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('optatives', true);

        // 6. pobles
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom_poble' => ['type' => 'VARCHAR', 'constraint' => '200'],
            'codi_postal' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'arxiu_consell_comarcal' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pobles', true);

        // 7. persones
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'cognom1' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'cognom2' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'identificacio' => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'data_naixement' => ['type' => 'DATE'],
            'telefon' => ['type' => 'VARCHAR', 'constraint' => '20', 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => '150', 'unique' => true],
            'adreca' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'id_poble' => ['type' => 'INT', 'unsigned' => true],
            'tsi' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'mutua' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true],
            'data_creacio' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_poble', 'pobles', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('persones', true);

        // 8. tutories
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_adult' => ['type' => 'INT', 'unsigned' => true],
            'id_menor' => ['type' => 'INT', 'unsigned' => true],
            'tipus_relacio' => ['type' => 'VARCHAR', 'constraint' => '50'], // Pare, Mare, Tutor Legal
            'data_caducitat_custodia' => ['type' => 'DATE', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_adult', 'persones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_menor', 'persones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tutories', true);

        // 9. doc_identitat
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_persona' => ['type' => 'INT', 'unsigned' => true],
            'tipus_doc' => ['type' => 'VARCHAR', 'constraint' => '50'],
            'ruta_arxiu' => ['type' => 'VARCHAR', 'constraint' => '255'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_persona', 'persones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('doc_identitat', true);

        // 10. matricules
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_alumne' => ['type' => 'INT', 'unsigned' => true],
            'id_curs' => ['type' => 'INT', 'unsigned' => true],
            'id_tanda' => ['type' => 'INT', 'unsigned' => true],
            'any_academic' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'estat' => ['type' => 'VARCHAR', 'constraint' => '50'], // pendent, validat, rebutjat
            'tipus_alumne' => ['type' => 'VARCHAR', 'constraint' => '50'], // nou, continuitat, repetidor
            'data_firma_imatge' => ['type' => 'DATETIME', 'null' => true],
            'import_total' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'notes_admin' => ['type' => 'TEXT', 'null' => true],
            'data_creacio' => ['type' => 'DATETIME'],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_alumne', 'persones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_curs', 'cursos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tanda', 'tandes', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('matricules', true);

        // 11. matricules_optatives
        $this->forge->addField([
            'id_matricula' => ['type' => 'INT', 'unsigned' => true],
            'id_optativa' => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addKey(['id_matricula', 'id_optativa']);
        $this->forge->addForeignKey('id_matricula', 'matricules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_optativa', 'optatives', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matricules_optatives', true);

        // 12. serveis
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom_servei' => ['type' => 'VARCHAR', 'constraint' => '200'],
            'preu_servei' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('serveis', true);

        // 13. cursos_serveis
        $this->forge->addField([
            'id_curs' => ['type' => 'INT', 'unsigned' => true],
            'id_servei' => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addKey(['id_curs', 'id_servei']);
        $this->forge->addForeignKey('id_curs', 'cursos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_servei', 'serveis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cursos_serveis', true);

        // 14. matricules_serveis
        $this->forge->addField([
            'id_matricula' => ['type' => 'INT', 'unsigned' => true],
            'id_servei' => ['type' => 'INT', 'unsigned' => true],
            'ruta_justificant_pagament' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
        ]);
        $this->forge->addKey(['id_matricula', 'id_servei']);
        $this->forge->addForeignKey('id_matricula', 'matricules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_servei', 'serveis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matricules_serveis', true);

        // 15. bonificacions
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom_bonificacio' => ['type' => 'VARCHAR', 'constraint' => '200'],
            'import_descompte' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bonificacions', true);

        // 16. matricules_bonificacions
        $this->forge->addField([
            'id_matricula' => ['type' => 'INT', 'unsigned' => true],
            'id_bonificacio' => ['type' => 'INT', 'unsigned' => true],
            'ruta_arxiu_comprovant' => ['type' => 'VARCHAR', 'constraint' => '255'],
        ]);
        $this->forge->addKey(['id_matricula', 'id_bonificacio']);
        $this->forge->addForeignKey('id_matricula', 'matricules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_bonificacio', 'bonificacions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matricules_bonificacions', true);

        // 17. inventari_taquilles
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom_fisic' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'id_matricula' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_matricula', 'matricules', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('inventari_taquilles', true);
    }

    public function down()
    {
        $this->forge->dropTable('inventari_taquilles', true);
        $this->forge->dropTable('matricules_bonificacions', true);
        $this->forge->dropTable('bonificacions', true);
        $this->forge->dropTable('matricules_serveis', true);
        $this->forge->dropTable('cursos_serveis', true);
        $this->forge->dropTable('serveis', true);
        $this->forge->dropTable('matricules_optatives', true);
        $this->forge->dropTable('matricules', true);
        $this->forge->dropTable('doc_identitat', true);
        $this->forge->dropTable('tutories', true);
        $this->forge->dropTable('persones', true);
        $this->forge->dropTable('pobles', true);
        $this->forge->dropTable('optatives', true);
        $this->forge->dropTable('tandes', true);
        $this->forge->dropTable('cursos', true);
        $this->forge->dropTable('etapes', true);
        $this->forge->dropTable('usuaris_secretaria', true);
    }
}
