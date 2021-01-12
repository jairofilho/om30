<?php namespace App\Controllers;

class Home extends BaseController
{

    public function __construct()
    {
        \Config\Services::session();
	}
	
	public function index()
	{
		$data['base'] = base_url();
		$data['logado'] = (isset($_SESSION['logado']) and $_SESSION['logado']) ? true : false;

		if ($data['logado'])
		{
			$data['title'] = " - Pacientes";
			return view('pacientes', $data);
		} else {
			$data['title'] = " - Login";
			$data['validacao'] = \Config\Services::validation()->listErrors();
			return view('login', $data);
		}
	}

}
