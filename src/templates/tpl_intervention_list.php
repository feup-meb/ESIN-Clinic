<section class="view">

    <h3>Lista de Intervenções</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Tipo de intervenção</th>
                <th>Data de deteção</th>
                <th>Equipamento</th>
                <th>Data ínicio</th>
                <th>Data de fim</th>
                <th>Observações</th>
                <th>Utilizador</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th colspan="3"></th>
                <?php }else{ ?>
                    <th colspan="2"></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaIntervencoes as $intervencao) { 
                $data_detetado = $intervencao['data_detetado'] != '' ? strtotime($intervencao['data_detetado']) : ''; 
                $data_inicio = $intervencao['data_inicio'] != '' ? strtotime($intervencao['data_inicio']) : ''; 
                $data_fim = $intervencao['data_fim'] != '' ? strtotime($intervencao['data_fim']) : ''; 
            ?>
                <tr>
                    <td><?=$intervencao['tipo']?></td>
                    <td><?=date("d/m/Y", $data_detetado)?></td>
                    <td><?=getEquipmentNameById($intervencao['id_equipamento'])?></td>
                    <td><?=date("d/m/Y", $data_inicio)?></td>
                    <td><?=date("d/m/Y", $data_fim)?></td>
                    <td><?=$intervencao['observacoes']?></td>
                    <td><?=getUserNameById($intervencao['id_empregado'])?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_intervention_edit.php'?>">
                                <button value="<?=$intervencao['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                    <?php } ?>
                    <td class="edit">
                        <form method="post" action="<?=SITE_ROOT.'intervention_edit.php'?>">
                            <button value="<?=$intervencao['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                        </form>
                    </td>
                    <td class="view">
                        <form method="get" action="<?=SITE_ROOT.'intervention_view.php'?>">
                            <button value="<?=$intervencao['id']?>" type="submit" name="view" class="list fas fa-info-circle"></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</section>