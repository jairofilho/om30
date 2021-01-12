<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Mdiversos extends Model
{
    
    public function login($usuario)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('om3_usuarios');
        $builder->select('usu_senha');
        $builder->where('usu_nome', $usuario);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

}