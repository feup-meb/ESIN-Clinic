<section class="view">

    <h3>Lista de Utilizadores</h3>
    <?php include('tpl_alert.php'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th>Nascimento</th>
                    <th>Morada</th>
                    <?php } ?>
                <th>Matricula</th>
                <th>Unidade</th>
                <?php if ($_SESSION['isManager']){ ?>
                    <th>Tipo de utilizador</th>
                    <th colspan="2"></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaUtilizadores as $utilizador) { 
                $data_nascimento = $utilizador['data_nascimento'] != '' ? strtotime($utilizador['data_nascimento']) : ''; 
            ?>
                <tr>
                    <td><?=$utilizador['nome']?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        <td><?=date("d/m/Y", $data_nascimento)?></td>
                        <td><?=$utilizador['morada']?></td>
                    <?php } ?>
                    <td><?=$utilizador['matricula']?></td>
                    <td><?=getUnitNameById($utilizador['id_unidade'])?></td>
                    <?php if ($_SESSION['isManager']){ ?>
                        <td><?=getUserTypeById($utilizador['tipo_utilizador'])?></td>
                        <td class="delete">
                            <form method="post" action="<?=ACT_DIR.'act_user_edit.php'?>">
                                <button value="<?=$utilizador['id']?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
                            </form>
                        </td>
                        <td class="edit">
                            <form method="post" action="<?=SITE_ROOT.'user_edit.php'?>">
                                <button value="<?=$utilizador['id']?>" type="submit" name="edit" class="list far fa-edit"></button>
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</section>