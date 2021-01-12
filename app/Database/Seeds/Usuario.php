<?php namespace App\Database\Seeds;

class Usuario extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'usu_nome' => 'jairo',
            'usu_senha' => '0e885731e62ac7276e1a4d88ff72a3ddd62b0cdb6cb5ea1ffdaa7bd0834fcec95bc325301642b84abce2b18bf72c42e612a04608ad00b8cdbac094193f3bec120e885731e62ac7276e1a4d88ff72a3ddd62b0cdb6cb5ea1ffdaa7bd0834fcec95bc325301642b84abce2b18bf72c42e612a04608ad00b8cdbac094193f3bec12'
        ];
        
        $this->db->table('om3_usuarios')->insert($data);
    }
}