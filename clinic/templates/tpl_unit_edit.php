<?php 

    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $unidade = getUnitById($_POST['edit']);
    }

?>
<section class="view">

    <h3>Adicionar Unidade(s)</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_unit_edit.php" method="post" name="unit_edit_form" id="unit_edit_form">
        <?= (isset($msg)) ? $msg : '' ?>
        Nome<input required name="nome" type="text" value="<?=$unidade['nome']?>">
        Sala<input required name="sala" type="text" value="<?=$unidade['sala']?>">

        <?php if(!$unidade) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>
    </form>
    
</section>