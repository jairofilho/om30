<?php namespace App\Controllers;

use App\Controllers\Home;
use App\Controllers\Diversos;
use App\Models\Mdiversos;

class Login extends BaseController
{

    public function __construct()
    {
        \Config\Services::session();
	}

	public function index()
	{
        $request = \Config\Services::request();
        $senha = $request->getVar('senha');
        $usuario = $request->getVar('usuario');
        $model = new Mdiversos();
        $diversos = new Diversos();
        $resultado = $model->login($usuario);

        $data['base'] = base_url();

        if (count($resultado) == 1 and $diversos->superSenha($senha) == $resultado[0]->usu_senha)
        {
            $_SESSION['logado'] = true;
			$data['logado'] = true;
			$data['title'] = " - Pacientes";
			return view('pacientes', $data);
        } else {
            $_SESSION['logado'] = false;
            $data['validacao'] = \Config\Services::validation()->listErrors();
			$data['title'] = " - Login";
            $data['invalido'] = true;
            return view('login', $data);
        }

	}

}