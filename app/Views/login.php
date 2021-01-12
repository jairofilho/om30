<?php require_once 'top.php'; ?>
<div class="centro">
    (Usuário: jairofilho - Senha: 12345678)
    <div class="loginTudo">
        <div class="login">
            <img class="loginLogo" src="<?php echo $base; ?>/assets/images/logo2.png" alt="logo">
            <div class="loginCampos">
                <?php echo $validacao; ?>
                <form action="<?php echo $base . "/login"; ?>" name="loginForm" id="loginForm" method="post" accept-charset="utf-8">
                    <input class="campo" type="text" name="usuario" placeholder="Usuário">
                    <br>
                    <input class="campo" type="password" name="senha" placeholder="Senha">
                    <br><br>
                    <input class="botao" type="submit" value="LOGIN">
                </form>
            </div>
        </div>
        <div id="erros" class="loginErros"><?php if (isset($invalido) and $invalido) echo "Usuário inválido"; ?></div>
    </div>
</div>
<script>
if ($("#loginForm").length > 0)
{
    $("#loginForm").validate({
        rules: {
            usuario: {
                required: true
            },
            senha: {
                required: true
            }
        },
        messages: {
            usuario: {
                required: "Usuário obrigatório"
            },
            senha: {
                required: "Senha obrigatória"
            }
        },
        errorElement : 'div',
        errorLabelContainer: '#erros'
    })
}
</script>
<?php require_once 'bot.php'; ?>