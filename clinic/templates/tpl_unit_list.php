<section class="view">

    <h3>Lista de Unidades</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sala</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th colspan="2"></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaUnidades as $unidade) { ?>
                <tr>
                    <td><?=$unidade['nome']?></td>
                    <td><?=$unidade['sala']?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_unit_edit.php'?>">
                                <button value="<?=$unidade['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                        <td class="edit">
                            <form method="post" action="<?=SITE_ROOT.'unit_edit.php'?>">
                                <button value="<?=$unidade['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                            </form>
                        </td>

                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</section>