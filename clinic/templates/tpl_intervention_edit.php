<?php 
    if (isset($_POST['edit'])){
        $id = $_POST['edit'];
        $intervencao = getInterventionById($_POST['edit']);
    }
?>
<section class="view">

    <h3>Adicionar intervenção</h3>
    <?php include('tpl_alert.php'); ?>
    <form action="<?=ACT_DIR?>act_intervention_edit.php" method="post" name="intervention_edit_form" id="intervention_edit_form">
        Data de deteção<input required name="data_detetado" type="date" value="<?=$intervencao['data_detetado']?>">
        Observações<textarea name="observacoes" cols="30" rows="10"><?=$intervencao['observacoes']?></textarea>
        Data da avaliação<input name="data_avaliacao" type="date" value="<?=$intervencao['data_avaliacao']?>">
        Orçamento<input name="orcamento" type="number" value="<?=$intervencao['orcamento']?>">
        Tipo de intervenção<input required name="tipo" type="text" value="<?=$intervencao['tipo']?>">
        Data de início do serviço<input name="data_inicio" type="date" value="<?=$intervencao['data_inicio']?>">
        Data de fim do serviço<input name="data_fim" type="date" value="<?=$intervencao['data_fim']?>">
        Utilizador que registou a intervenção<select disabled name="id_utilizador">
        <option selected value="<?=$userId?>"><?=$nomeUtilizador?></option>
            <?php 
                // foreach ($listaUtilizadores as $utilizador) {
                // $selected = ($intervencao['id_empregado'] == $userId ) ? 'selected disabled' : ''; ?>
                <!-- <option <=$selected?> value="<=$utilizador['id']?>"><=$utilizador['nome']?></option> -->
            <?php // } ?>
        </select>
        Equipamento que sofrerá intervenção<select name="id_equipamento">
            <?php foreach ($listaEquipamentos as $equipamento) {
                $selected = ($intervencao['id_equipamento'] == $equipamento['id'] ) ? 'selected' : ''; ?>
                <option <?=$selected?> value="<?=$equipamento['id']?>"><?=$equipamento['nome'] . ' (' . $equipamento['modelo'] . ')'?></option>
            <?php } ?>
        </select>

        <?php if(!$intervencao) { ?>
            <?php include_once('tpl_new_btn.php'); ?>
        <?php }else{ ?>
            <?php include_once('tpl_edit_btn.php'); ?>
        <?php } ?>
        <?php include_once('tpl_cancel_btn.php'); ?>
    </form>

</section>