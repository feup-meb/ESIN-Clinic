<section class="view">

    <h3>Lista de Fabricantes</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Telemóvel</th>
                <th>Morada</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th colspan="2"></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaFabricantes as $fabricante) { ?>
                <tr>
                    <td><?=$fabricante['nome']?></td>
                    <td><?=$fabricante['email']?></td>
                    <td><?=$fabricante['telefone']?></td>
                    <td><?=$fabricante['telemovel']?></td>
                    <td><?=$fabricante['morada']?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                    
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_manufacturer_edit.php'?>">
                                <button value="<?=$fabricante['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                        <td class="edit">
                            <form method="post" action="<?=SITE_ROOT.'manufacturer_edit.php'?>">
                                <button value="<?=$fabricante['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                            </form>
                        </td>

                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

