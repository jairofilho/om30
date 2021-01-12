<?php namespace App\Controllers;

use App\Models\Mpacientes;

class Pacientes extends BaseController
{

    public function __construct()
    {
        \Config\Services::session();
	}
	
	// Página inicial de pacientes
	public function index($mensagem = false)
	{
		
		$data['base'] = base_url();
		$data['logado'] = (isset($_SESSION['logado']) and $_SESSION['logado']) ? true : false;

		if ($data['logado'])
		{
			$data['title'] = " - Pacientes";
			$data['mensagem'] = $mensagem;
			return view('pacientes', $data);
		} else {
			$data['title'] = " - Login";
			return view('login', $data);
		}
	}

	// Retorna lista de pacientes
	public function lista()
	{
        $model = new Mpacientes();
		$dados = $model->lista();
		$data['dados'] = $dados;
        return json_encode($dados);
	}

	// Exclui registro
	public function excluir($registro)
	{
		$model = new Mpacientes();
		$data['mensagem'] = ($model->excluir($registro) > 0) ? "Registro excluido" : "Nenhum registro foi excluido";
		$data['title'] = " - Pacientes";
		$data['base'] = base_url();
		@unlink("./public/uploads/pacientes/$registro.jpg");
		return view('pacientes', $data);
	}

	// Exibe detalhes do registro
	public function exibir($registro)
	{
		$model = new Mpacientes();
		$dados = $model->editar($registro)[0];
		$dados->pac_nascimento = date('d/m/Y', strtotime($dados->pac_nascimento));
		$data['fotoexiste'] = (is_file(getcwd() . "\\public\\uploads\\pacientes\\$registro.jpg")) ? true : false;
		$data['foto'] = "../../public/uploads/pacientes/$registro.jpg";
		$data['dados'] = $dados;
		$data['title'] = " - Exibir paciente";
		$data['base'] = base_url();
		$data['logado'] = (isset($_SESSION['logado']) and $_SESSION['logado']) ? true : false;
		return view('pacientes_exibir', $data);
	}

	// Abre formulário para edição
	public function editar($registro, $mensagem = false)
	{
		$model = new Mpacientes();
		$dados = $model->editar($registro)[0];
		$dados->pac_nascimento = date('d/m/Y', strtotime($dados->pac_nascimento));
		$data['dados'] = json_encode($dados);
		$data['title'] = " - Editar paciente";
		$data['base'] = base_url();
		$data['logado'] = (isset($_SESSION['logado']) and $_SESSION['logado']) ? true : false;
		$data['estados'] = json_decode(view('combo_estados'));
		$data['mensagem'] = $mensagem;
		$data['registro'] = $registro;
		return view('pacientes_editar', $data);
	}

    // Altera registro
    public function gravar($registro)
    {
        $request = \Config\Services::request();
        $dados = [
            'pac_nome' => $request->getVar('pac_nome'),
            'pac_mae' => $request->getVar('pac_mae'),
            'pac_cpf' => $request->getVar('pac_cpf'),
            'pac_cns' => $request->getVar('pac_cns'),
            'pac_nascimento' => $request->getVar('pac_nascimento'),
            'pac_endereco' => $request->getVar('pac_endereco'),
            'pac_numero' => $request->getVar('pac_numero'),
            'pac_complemento' => $request->getVar('pac_complemento'),
            'pac_bairro' => $request->getVar('pac_bairro'),
            'pac_cidade' => $request->getVar('pac_cidade'),
            'pac_estado' => $request->getVar('pac_estado'),
            'pac_cep' => $request->getVar('pac_cep')
        ];
        if (!empty($dados['pac_nome'])) { $_SESSION['podeinserir'] = true; }

        // Monta objeto para busca
        $busca['pac_cpf'] = $request->getVar('pac_cpf');
        $busca['pac_id !='] = $registro;

        // Verifica se existe
        $model = new Mpacientes();
		$existe = $model->contaRegistro($busca, 'om3_pacientes');
		
		if ($existe != 0)
		{
			return $this->editar($registro, 'Paciente já cadastrado');
		} else {
			$dados['pac_nascimento'] = ($request->getVar('pac_nascimento') != "") ? date('Y-m-d', strtotime(str_replace('/', '-', $request->getVar('pac_nascimento')))) : null;
			$edita = $model->grava($registro, 'pac_id', 'om3_pacientes', $dados);
			if ($edita)
			{
				$temimagem = $this->imagem($registro);
				return $this->index('Paciente alterado com sucesso');
			} else {
				return $this->editar($registro, 'Falha na alteração do paciente');
			}
		}
    }

	// Abre formulário para inserção
	public function inserir($mensagem = false, $dados = false)
	{
		$data['title'] = " - Inserir paciente";
		$data['base'] = base_url();
		$data['logado'] = (isset($_SESSION['logado']) and $_SESSION['logado']) ? true : false;
		$data['estados'] = json_decode(view('combo_estados'));
		$data['mensagem'] = $mensagem;
		$data['dados'] = json_encode($dados);
		return view('pacientes_inserir', $data);
	}

    // Cria novo registro
    public function criar()
    {
        $request = \Config\Services::request();
        $dados = [
            'pac_nome' => $request->getVar('pac_nome'),
            'pac_mae' => $request->getVar('pac_mae'),
            'pac_cpf' => $request->getVar('pac_cpf'),
            'pac_cns' => $request->getVar('pac_cns'),
            'pac_nascimento' => $request->getVar('pac_nascimento'),
            'pac_endereco' => $request->getVar('pac_endereco'),
            'pac_numero' => $request->getVar('pac_numero'),
            'pac_complemento' => $request->getVar('pac_complemento'),
            'pac_bairro' => $request->getVar('pac_bairro'),
            'pac_cidade' => $request->getVar('pac_cidade'),
            'pac_estado' => $request->getVar('pac_estado'),
            'pac_cep' => $request->getVar('pac_cep')
        ];
        if (!empty($dados['pac_nome'])) { $_SESSION['podeinserir'] = true; }

        // Monta objeto para busca
        $busca['pac_cpf'] = $request->getVar('pac_cpf');

        // Verifica se existe
        $model = new Mpacientes();
		$existe = $model->contaRegistro($busca, 'om3_pacientes');
		
		if ($existe != 0)
		{
			return $this->inserir('Paciente já cadastrado', $dados);
		} else {
			$dados['pac_nascimento'] = ($request->getVar('pac_nascimento') != "") ? date('Y-m-d', strtotime(str_replace('/', '-', $request->getVar('pac_nascimento')))) : null;
			$insere = $model->insere('om3_pacientes', $dados);
			if ($insere > 0)
			{
				return $this->index('Paciente inserido com sucesso');
			} else {
				$dados['pac_nascimento'] = $request->getVar('pac_nascimento');
				return $this->inserir('Falha na inserção do paciente', $dados);
			}
		}
	}
	
	// Upload da imagem
	public function imagem($id)
	{
		$foto = $this->request->getFile('pac_foto');
		$nomeTemp = $foto->getTempName();
        if ($nomeTemp != "")
        {
            $ext = $foto->getClientExtension();
            $nome = "$id.$ext";
            if ($foto->move('./public/uploads/temp', $nome))
            {
                $diversos = new Diversos();
                $diversos->foto($id, $ext, 600);
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

}
