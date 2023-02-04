<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $categoria = getcategoryById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar categoria de equipamento</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_category_edit.php" method="post" name="category_edit_form" id="category_edit_form">
        Nome<input required name="nome" type="text" value="<?=$categoria['nome']?>">
        Descrição<input required name="descricao" type="text" value="<?=$categoria['descricao']?>">

        <?php if(!$categoria) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>
    </form>

</section>