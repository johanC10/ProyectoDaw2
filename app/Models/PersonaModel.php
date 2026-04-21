<?php
namespace App\Models;
use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table = 'persones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'cognom1', 'cognom2', 'identificacio', 'data_naixement', 'telefon', 'email', 'adreca', 'id_poble', 'tsi', 'mutua', 'data_creacio'];
    protected $useTimestamps = true;
    protected $createdField  = 'data_creacio';
    protected $updatedField  = '';
}
