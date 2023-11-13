<?php 
    if (!empty($_GET['view'])){
        $id = $_GET['view'];
        $equipamento = getEquipmentById($_GET['view']);
    }else{
        die(header('Location: ' . SITE_ROOT . 'equipment.php'));
    }
?>
<section class="view">

    <h3><?=$titulo_pagina?></h3>
    <?php include('tpl_alert.php'); ?>
    <table class="detail">
        <tr><th>Nome:</th><td><?=$equipamento['nome']?></td></tr>
        <tr><th>Modelo:</th><td><?=$equipamento['modelo']?></td></tr>
        <tr><th>Fabricante:</th><td><?=getManufacturerNameById($equipamento['id_fabricante'])?></td></tr>
        <tr><th>Descrição:</th><td><?=$equipamento['descricao']?></td></tr>
        <tr><th>Categoria:</th><td><?=getCategoryNameById($equipamento['id_categoria'])?></td></tr>
        <tr><th>Data de aquisição:</th><td><?=date("d/m/Y", strtotime($equipamento['data_aquisicao']))?></td></tr>
        <tr><th>Data de garantia:</th><td><?=date("d/m/Y", strtotime($equipamento['data_garantia']))?></td></tr>
        <tr><th>Valor de compra:</th><td><?=number_format($equipamento['valor_compra'],2,",",".").' &euro;'?></td></tr>
        <tr><th>Status:</th><td><?=$equipamento['ativo'] ? 'Ativo' : 'Parado'?></td></tr>
        <tr><th>Unidade:</th><td><?=getUnitNameById($equipamento['id_unidade'])?></td></tr>
    </table>
    <?php include_once('tpl_back_btn.php'); ?>
</section>