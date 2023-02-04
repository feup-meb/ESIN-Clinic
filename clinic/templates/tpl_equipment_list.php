<section class="view">

    <h3>Lista de Equipamentos</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Modelo</th>
                <!-- <th>Descrição</th> -->
                <th>Fabricante</th>
                <!-- <th>Categoria</th> -->
                <th>Unidade</th>
                <th>Ativo</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th colspan="3"></th>
                <?php }else{ ?>
                    <th></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaEquipamentos as $equipamento) { ?>
                <tr>
                    <td><?=$equipamento['nome']?></td>
                    <td><?=$equipamento['modelo']?></td>
                    <!-- <td><=$equipamento['descricao']?></td> -->
                    <td><?=getManufacturerNameById($equipamento['id_fabricante'])?></td>
                    <!-- <td><=getCategoryNameById($equipamento['id_categoria'])?></td> -->
                    <td><?=getUnitNameById($equipamento['id_unidade'])?></td>
                    <td><?=$equipamento['ativo'] ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_equipment_edit.php'?>">
                                <button value="<?=$equipamento['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                        <td class="edit">
                            <form method="post" action="<?=SITE_ROOT.'equipment_edit.php'?>">
                                <button value="<?=$equipamento['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                            </form>
                        </td>
                    <?php } ?>
                    <td class="view">
                        <form method="get" action="<?=SITE_ROOT.'equipment_view.php'?>">
                            <button value="<?=$equipamento['id']?>" type="submit" name="view" class="list fas fa-info-circle"></button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</section>