<div class="content">
    <header id="login_header">
        <img class="cover" src="<?=IMG_DIR?>/logo.png" alt="Imagem de capa">
        <h2><?=$titulo_pagina?></h2>
    </header>
    <section id="login_form">
        <form action="<?=ACT_DIR?>act_login.php" method="post" name="Login_Form">
            <?php include('tpl_alert.php'); ?>
            Utilizador<input required name="utilizador" type="text" value="<?=$utilizador?>">
            Palavra-passe<input required name="palavra_passe" type="password">
            
            <button name="login" type="submit" value="alterar" class="btn tooltip">
                <span class="tooltiptext">Entrar</span>
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
    </section>
</div>