<?php namespace App\Controllers;

class Diversos extends BaseController
{

    public function __construct()
    {
        \Config\Services::session();
    }
    
    // FORTALECE A SENHA FORNECIDA
    public function superSenha($senha)
    {
        $asc = "!#$&()*+,-.0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[]^_abcdefghijklmnopqrstuvwxyz{|}~ÇüééâäàåçêëèïîìÄæÆöòûùÿÖÜ¢£¥₧ƒáíóúñÑªº¿⌐¬½¼¡«»░▒▓│┤╡╢╖╕╣║╗╝╜╛┐└┴┬├─┼╞╟╚╔╩╦╠═╬╧╨╤╥╙╘╒╓╫╪┘┌█▄▌▐▀αßΓπΣσµτΦΘΩδ∞φε∩≡±≥≤⌠÷≈°∙·√ⁿ²■";

        $retorno = "";
        $semente = 0;
        $tamanho = strlen($senha);
        $maximo = ceil(128 / $tamanho);
        
        srand($tamanho);
        $asc = str_shuffle($asc);

        for ($i = 0; $i < $tamanho; $i++)
        {
            for ($j = 0; $j < $maximo; $j++)
            {
                $semente += ord($senha[$i]) + $j + $tamanho;
                srand(ord($senha[$i]) + $j + $tamanho);
                $retorno .= $asc[rand() % strlen($asc)];
            }
        }

        srand($semente);
        $retorno = str_shuffle($retorno);

        $parte1 = substr($retorno, 0, 128);
        $parte2 = substr($retorno, -128);

        $parte1 = hash('whirlpool', $parte1);
        $parte2 = hash('whirlpool', $parte2);

        $retorno = $parte1 . $parte2;
        
        return $retorno;
    }

    // CONSULTA CEP
    public function cep($cep)
    {
        return file_get_contents("https://viacep.com.br/ws/$cep/json/");
    }


    // REDIMENSIONA FOTO
    function foto($id, $ext, $maximo)
    {
        
        $foto = "./public/uploads/temp/$id.$ext";
        $destino = "./public/uploads/pacientes/$id.jpg";
        
        $image = \Config\Services::image()
            ->withFile($foto)
            ->flatten(255, 255, 255)
            ->resize($maximo, $maximo, true, 'auto')
            ->save($destino);

        @unlink($foto);
    }

}