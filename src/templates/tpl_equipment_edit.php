<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $equipamento = getEquipmentById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar equipamento</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_equipment_edit.php" method="post" name="equipmemt_edit_form" id="equipmemt_edit_form">
        Nome<input required name="nome" type="text" value="<?=$equipamento['nome']?>">
        Modelo<input required name="modelo" type="text" value="<?=$equipamento['modelo']?>">
        Número de série<input required name="nr_serie" type="text"de série" value="<?=$equipamento['nr_serie']?>">
        Descrição<textarea name="descricao" cols="30" rows="10"><?=$equipamento['descricao']?></textarea>
        Fabricante<select name="id_fabricante">
            <?php foreach ($listaFabricantes as $fabricante) {
                $selected = ($equipamento['id_fabricante'] == $fabricante['id'] ) ? 'selected' : ''; ?>
                <option value="<?=$fabricante['id']?>"><?=getManufacturerNameById($fabricante['id'])?></option>
             <?php } ?>
        </select>
        Categoria<select name="id_categoria">
            <?php foreach ($listaCategorias as $categoria) {
                $selected = ($equipamento['id_categoria'] == $categoria['id'] ) ? 'selected' : ''; ?>
                <option value="<?=$categoria['id']?>"><?=getCategoryNameById($categoria['id'])?></option>
             <?php } ?>
        </select>
        Data de aquisição<input required name="data_aquisicao" type="date" value="<?=$equipamento['data_aquisicao']?>">
        Data de garantia<input required name="data_garantia" type="date" value="<?=$equipamento['data_garantia']?>">
        Valor da compra<input required name="valor_compra" type="number" value="<?=$equipamento['valor_compra']?>">
        Ativo?<input name="ativo" type="checkbox" <?=$equipamento['ativo'] ? 'checked' : ''?>>
        Unidade<select name="id_unidade">
            <?php foreach ($listaUnidades as $unidade) {
                $selected = ($equipamento['id_unidade'] == $unidade['id'] ) ? 'selected' : ''; ?>
                <option value="<?=$unidade['id']?>"><?=$unidade['nome']?> (<?=$unidade['sala']?>)</option>
            <?php }?>
        </select>

        <?php if(!$equipamento) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>
    </form>

</section>