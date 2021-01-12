<?php namespace App\Controllers;

use App\Controllers\Home;

class Sair extends BaseController
{

    public function __construct()
    {
        \Config\Services::session();
	}

	public function index()
	{

		$home = new Home();
		$_SESSION['logado'] = false;
		$_SESSION['usuario'] = "";
		$_SESSION['senha'] = "";
		return $home->index();

	}

}