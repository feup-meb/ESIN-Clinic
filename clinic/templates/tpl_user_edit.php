<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $utilizador = getUserById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar utilizador</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_user_edit.php" method="post" name="user_edit_form" id="user_edit_form">
        Nome<input required name="nome" type="text" value="<?=$utilizador['nome']?>">
        Matrícula<input required name="utilizador" type="text" value="<?=$utilizador['matricula']?>">
        Data de Nascimento<input name="data_nascimento" type="date" value="<?=$utilizador['data_nascimento']?>">
        Morada<input name="morada" type="text" value="<?=$utilizador['morada']?>">
        Unidade<select name="id_unidade">
            <?php foreach ($listaUnidades as $unidade) { 
                $selected = ($utilizador['id_unidade'] == $unidade['id'] ) ? 'selected' : ''; ?>
                <option <?=$selected?> value="<?=$unidade['id']?>"><?=$unidade['nome']?></option>
            <?php } ?>
        </select>
        Tipo de utilizador<select name="tipo_utilizador">
            <?php foreach ($listaTipoUtilizador as $tipo) {
                $selected = ($utilizador['tipo_utilizador'] == $tipo['id'] ) ? 'selected' : ''; ?>
                    <option <?=$selected?> value="<?=$tipo['id']?>"><?=$tipo['tipo']?></option>
            <?php } ?>
        </select>

        <?php if(!$utilizador) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>

    </form>

</section>