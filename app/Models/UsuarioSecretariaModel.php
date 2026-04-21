<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuarioSecretariaModel extends Model
{
    protected $table = 'usuaris_secretaria';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuari', 'password_hash', 'rol', 'data_ultim_acces'];
    protected $useTimestamps = false;
}
