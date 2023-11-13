<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $tipoUtilizador = getTypeById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar tipo de utilizador</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_userType_edit.php" method="post" name="userType_edit_form" id="userType_edit_form">
        Tipo de utilizador<input required name="tipoUtilizador" type="text" value="<?=$tipoUtilizador?>">
        
        <input type="hidden" name="edit" value="<?=$id?>">

        <?php if(!$tipoUtilizador) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>

    </form>

</section>