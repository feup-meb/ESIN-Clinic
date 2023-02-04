<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $fabricante = getManufacturerById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar Fabricante</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_manufacturer_edit.php" method="post" name="manufacturer_edit_form" id="manufacturer_edit_form">
        Nome<input required name="nome" type="text" value="<?=$fabricante['nome']?>">
        Email<input required name="email" type="email" value="<?=$fabricante['email']?>">
        Telefone<input required name="telefone" type="tel" value="<?=$fabricante['telefone']?>">
        Telemóvel<input required name="telemovel" type="tel" value="<?=$fabricante['telemovel']?>">
        Morada<input required name="morada" type="text" value="<?=$fabricante['morada']?>">
        
        <?php if(!$fabricante) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>
    </form>
    
</section>