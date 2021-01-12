<?php
require_once 'top.php';
require_once 'menu.php';
?>
<div class="conteudo">
    <div class="titulo">Editar paciente</div>
    <div class="formulario">
        <form method="post" name="formulario" id="formulario" action="<?php echo $base; ?>/pacientes/gravar/<?php echo $registro; ?>" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="linhaForm">
                <div class="colunaForm1">Nome<span class="ob">*<span id="pac_nomeOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_nome" id="pac_nome">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Nome da mãe<span class="ob">*<span id="pac_maeOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_mae" id="pac_mae">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">CPF<span class="ob">*<span id="pac_cpfOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_cpf" id="pac_cpf">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">CNS<span class="ob">*<span id="pac_cnsOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_cns" id="pac_cns">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Data de nascimento<span class="ob">*<span id="pac_nascimentoOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_nascimento" id="pac_nascimento">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">CEP<span class="ob">*<span id="pac_cepOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_cep" id="pac_cep">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Endereço<span class="ob">*<span id="pac_enderecoOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_endereco" id="pac_endereco">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Número<span class="ob">*<span id="pac_numeroOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_numero" id="pac_numero">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Complemento</div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_complemento" id="pac_complemento">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Bairro<span class="ob">*<span id="pac_bairroOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_bairro" id="pac_bairro">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Cidade<span class="ob">*<span id="pac_cidadeOb"></span></span></div>
                <div class="colunaForm2">
                    <input class="campoForm" type="text" name="pac_cidade" id="pac_cidade">
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Estado<span class="ob">*<span id="pac_estadoOb"></span></span></div>
                <div class="colunaForm2">
                    <select class="campoForm" name="pac_estado" id="pac_estado">
                        <option value="">Selecione o estado</option>
                        <?php foreach($estados as $linha) { ?>
                            <option value="<?php echo $linha->id; ?>"><?php echo $linha->value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="linhaForm">
                <div class="colunaForm1">Foto</div>
                <div class="colunaForm2">
                    <input class="campoForm" type="file" name="pac_foto" id="pac_foto">
                </div>
            </div>
            <div class="linhaForm">
                <input class="botaoForm" type="submit" value="Enviar">
                <input class="botaoForm" type="button" value="Voltar" onClick="location.href='../../pacientes'">
            </div>
        </form>
    </div>
</div>
<script>
    
    function aplicaMascaras()
    {
        $('#pac_cpf').mask('000.000.000-00');
        $('#pac_cep').mask('00000-000');
        $('#pac_nascimento').mask('00/00/0000');
        $('#pac_cns').mask('000 0000 0000 0000');
    }

    function valida() {
		var envia = true;
        var obrigatorios = ['pac_nome', 'pac_mae', 'pac_cpf', 'pac_cns', 'pac_nascimento', 'pac_cep', 'pac_endereco', 'pac_numero', 'pac_bairro', 'pac_cidade', 'pac_estado'];
        for (var i = 0; i < obrigatorios.length; i++)
        {
            if ($('#' + obrigatorios[i]).val() == "")
            {
				$('#' + obrigatorios[i] + 'Ob').html(' Campo obrigatório');
				var envia = false;
            } else {
                $('#' + obrigatorios[i] + 'Ob').html('');
            }
        }
        cpf = $('#pac_cpf').val();
        if (cpf.length > 0)
        {
            cpf = validaCPF(cpf);
            if (!cpf)
            {
                $('#pac_cpfOb').html(' CPF inválido');
				var envia = false;
            } else {
                $('#pac_cpfOb').html('');
            }
        }
        cns = $('#pac_cns').val();
        if (cns.length > 0)
        {
            cns = validaCNS(cns);
            if (!cns)
            {
                $('#pac_cnsOb').html(' CNS inválido');
				var envia = false;
            } else {
                $('#pac_cnsOb').html('');
            }
        }
        nascimento = $('#pac_nascimento').val();
        if (nascimento.length > 0)
        {
            nascimento = validaData(nascimento);
            if (!nascimento)
            {
                $('#pac_nascimentoOb').html(' Data inválida');
				var envia = false;
            } else {
                $('#pac_nascimentoOb').html('');
            }
		}
		
		return envia;
    }

    $('#formulario').submit(function() {
        return valida();
    });

    $(document).ready(function(){
        aplicaMascaras();
        $('#pac_cep').keyup(function() {
            cepvalor = $('#pac_cep').val()
            if (cepvalor.length == 9)
            {
                cepteste = JSON.parse(viacep('<?php echo $base; ?>/diversos/cep/' + cepvalor));
                if (cepteste !== false)
                {
                    $('#pac_endereco').val(cepteste.logradouro);
                    $('#pac_bairro').val(cepteste.bairro);
                    $('#pac_cidade').val(cepteste.localidade);
                    $('#pac_complemento').val(cepteste.complemento);
                    $('#pac_estado option[value='+cepteste.uf+']').attr('selected', 'selected');
                }
            }
        });
		var dados = '<?php if (isset($dados)) echo "[$dados]"; ?>';
		dados = JSON.parse(dados);
        if (dados != "")
        {
            obrigatorios = ['pac_nome', 'pac_mae', 'pac_cpf', 'pac_cns', 'pac_nascimento', 'pac_cep', 'pac_endereco', 'pac_numero', 'pac_bairro', 'pac_cidade', 'pac_estado'];
            for (var i = 0; i < obrigatorios.length; i++) $('#' + obrigatorios[i]).val(eval("dados[0]." + obrigatorios[i]));
        }
    });
	
	var mensagem = "<?php echo $mensagem; ?>";
	if (mensagem != "") webix.alert(mensagem,"alert-warning");

</script>
<?php require_once 'bot.php'; ?>