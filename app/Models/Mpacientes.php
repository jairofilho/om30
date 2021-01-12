<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Mpacientes extends Model
{
    
    public function lista()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('om3_pacientes');
        $builder->select();
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function excluir($registro)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('om3_pacientes');
        $builder->delete(['pac_id' => $registro]);
        $retorno = $db->affectedRows();
        return $retorno;
    }
    
    public function editar($registro)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('om3_pacientes');
        $builder->select();
        $builder->where('pac_id', $registro);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function contaRegistro($busca, $tabela)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tabela);
        $builder->selectCount('pac_id');
        foreach($busca as $chave => $valor)
        {
            $builder->where($chave, $valor);
        }
        $query = $builder->get();
        $result = $query->getResult();
        return $result[0]->pac_id;
    }
    
    public function insere($tabela, $dados)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tabela);
        $builder->set($dados);
        $builder->insert();
        return $db->insertID();
    }
    
    public function grava($valor, $campo, $tabela, $dados)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($tabela);
        $builder->where($campo, $valor);
        $builder->set($dados);
        if ($builder->update()) { return true; } else { return false; }
    }

}