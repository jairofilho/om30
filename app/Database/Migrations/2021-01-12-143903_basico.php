<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Basico extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'pac_id'=> [
				'type' => 'BIGINT',
				'auto_increment' => true
			],
			'pac_nome'=> [
				'type' => 'VARCHAR',
				'constraint' => '256'
			],
			'pac_mae'=> [
				'type' => 'VARCHAR',
				'constraint' => '256'
			],
			'pac_cpf'=> [
				'type' => 'VARCHAR',
				'constraint' => '14'
			],
			'pac_cns'=> [
				'type' => 'VARCHAR',
				'constraint' => '18'
			],
			'pac_nascimento'=> [
				'type' => 'date'
			],
			'pac_endereco'=> [
				'type' => 'VARCHAR',
				'constraint' => '256'
			],
			'pac_numero'=> [
				'type' => 'VARCHAR',
				'constraint' => '32'
			],
			'pac_complemento'=> [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'pac_bairro'=> [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'pac_cidade'=> [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'pac_estado'=> [
				'type' => 'VARCHAR',
				'constraint' => '2'
			],
			'pac_cep'=> [
				'type' => 'VARCHAR',
				'constraint' => '9'
			]
		]);
		$this->forge->addKey('pac_id', true);
		$this->forge->createTable('om3_pacientes');

		$this->forge->addField([
			'usu_id'=> [
				'type' => 'BIGINT',
				'auto_increment' => true
			],
			'usu_nome'=> [
				'type' => 'VARCHAR',
				'constraint' => '16'
			],
			'usu_senha'=> [
				'type' => 'VARCHAR',
				'constraint' => '256'
			]
		]);
		$this->forge->addKey('usu_id', true);
		$this->forge->createTable('om3_usuarios');

		$seeder = \Config\Database::seeder();
		$seeder->call('Usuario');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('om3_pacientes');
		$this->forge->dropTable('om3_usuarios');
	}
}