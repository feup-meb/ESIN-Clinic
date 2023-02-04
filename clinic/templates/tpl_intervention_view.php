<?php 
    if (!empty($_GET['view'])){
        $id = $_GET['view'];
        $intervention = getInterventionById($_GET['view']);
    }else{
        die(header('Location: ' . SITE_ROOT . 'intervention.php'));
    }
?>
<section class="view">

    <h3><?=$titulo_pagina?></h3>
    <?php include('tpl_alert.php'); ?>
    <table class="detail">
        <tr><th>Data de deteção:</th><td><?=date("d/m/Y", strtotime($intervention['data_detetado']))?></td></tr>
        <tr><th>Observações:</th><td><?=$intervention['observacoes']?></td></tr>
        <tr><th>Data da avaliação:</th><td><?=date("d/m/Y", strtotime($intervention['data_avaliacao']))?></td></tr>
        <tr><th>Orçamento:</th><td><?=number_format($intervention['orcamento'],2,",",".").' &euro;'?></td></tr>
        <tr><th>Tipo de intervenção:</th><td><?=$intervention['tipo']?></td></tr>
        <tr><th>Data de início do serviço:</th><td><?=date("d/m/Y", strtotime($intervention['data_inicio']))?></td></tr>
        <tr><th>Data de fim do serviço:</th><td><?=date("d/m/Y", strtotime($intervention['data_fim']))?></td></tr>
        <tr><th>Utilizador que registou a intervenção:</th><td><?=getUsernameById($intervention['id_empregado'])?></td></tr>
        <tr><th>Equipamento que sofrerá intervenção:</th><td><?=getEquipmentnameById($intervention['id_equipamento'])?></td></tr>
    </table>
    <?php include_once('tpl_back_btn.php'); ?>

</section>