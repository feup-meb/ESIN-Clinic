<section class="view">

    <h3>Modificar palavra-passe</h3>
    <?php include('tpl_alert.php'); ?>
    <section id="pass_change_form">
        <form action="<?=ACT_DIR?>act_password_edit.php" method="post" name="Pass_Change_Form">
            Palavra-passe atual<input required name="palavra_passe_antiga" type="password">
            Nova palavra-passe<input required name="palavra_passe_nova" type="password">
            Confirmação da nova palavra-passe<input required name="palavra_passe_confirma" type="password">

            <button name="login" type="submit" value="alterar" class="btn tooltip">
                <span class="tooltiptext">Confirmar edição</span>
                <i class="fas fa-check"></i>
            </button>
            <?php include_once('tpl_cancel_btn.php'); ?>
        </form>
    </section>
</div>