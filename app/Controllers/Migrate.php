<?php namespace App\Controllers;

class Migrate extends \CodeIgniter\Controller
{
    
    public function index()
    {
        $migrate = \Config\Services::migrations();
        try
        {
            $migrate->latest();
            echo 'MIGRAÇÃO COM SUCESSO';
        } catch (\Throwable $e) {
            echo 'ERRO NA MIGRAÇÃO';
        }
    }

}