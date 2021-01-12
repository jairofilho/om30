<?php
require_once 'top.php';
require_once 'menu.php';
?>
<div class="conteudo">
    <div class="titulo">Exibir paciente</div>
    <div class="formulario">
        <?php if ($fotoexiste) { ?>
        <div class="linhaForm"><img class="foto" src="<?php echo $foto; ?>" alt="foto"></div>
        <?php } ?>
        <div class="linhaForm">
            <div class="colunaForm3">Nome: <?php echo $dados->pac_nome; ?></div>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Nome da mãe: <?php echo $dados->pac_mae; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">CPF: <?php echo $dados->pac_cpf; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">CNS: <?php echo $dados->pac_cns; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Data de nascimento: <?php echo $dados->pac_nascimento; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">CEP: <?php echo $dados->pac_cep; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Endereço: <?php echo $dados->pac_nome . ", " . $dados->pac_numero; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Complemento: <?php echo $dados->pac_complemento; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Bairro: <?php echo $dados->pac_bairro; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Cidade: <?php echo $dados->pac_cidade; ?>
        </div>
        <div class="linhaForm">
            <div class="colunaForm3">Estado: <?php echo $dados->pac_estado; ?>
        </div>
        <div class="linhaForm">
            <input class="botaoForm" type="button" value="Editar" onClick="location.href='../../pacientes/editar/<?php echo $dados->pac_id; ?>'">
            <input class="botaoForm" type="button" value="Voltar" onClick="location.href='../../pacientes'">
        </div>
    </div>
</div>
<?php require_once 'bot.php'; ?>