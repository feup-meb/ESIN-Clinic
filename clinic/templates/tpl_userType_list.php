<section class="view">

    <h3>Lista de Tipos de utilizador</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th colspan="2"></th>
                <?php } ?>                           
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaTiposUtilizador as $tipoUtilizador) { ?>
                <tr>
                    <td><?=$tipoUtilizador['tipo']?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_userType_edit.php'?>">
                                <button value="<?=$tipoUtilizador['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                        <td class="edit">
                            <form method="post" action="<?=SITE_ROOT.'userType_edit.php'?>">
                                <button value="<?=$tipoUtilizador['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</section>