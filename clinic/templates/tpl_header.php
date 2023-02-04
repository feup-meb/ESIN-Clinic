<header id="header" class="header">
    <h1><?=PROJETO?></h1>
    <?php if(isset($_SESSION)){ ?>
        <section>
            <ul id="userMenu">
                <li>
                    <a href="#">Bem vindo <?=$nomeUtilizador?></a>
                    <ul class="userSubmenu">
                        <li><a href="password_edit.php">Alterar palavra-passe</a></li>
                        <li><a href="<?=ACT_DIR.'act_logout.php'?>">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    <?php } ?>
</header>
<?php if(isset($_SESSION)){ ?>
    <nav>
        <ul id="sideMenu">
            <li>
                <a href="#">Intervenções</a>
                <ul class="submenu">
                    <li><a href="intervention.php">Listar intervenções</a></li>
                    <li><a href="intervention_edit.php">Nova intervenção</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Unidades</a>
                <ul class="submenu">
                    <li><a href="unit.php">Listar unidades</a></li>
                    <?php if ($_SESSION['isManager']){ ?>
                        <li><a href="unit_edit.php">Nova unidade</a></li>
                    <?php }?>
                </ul>
            </li>
            <li>
                <a href="#">Equipamentos</a>
                <ul class="submenu">
                    <li><a href="equipment.php">Listar equipamentos</a></li>
                    <?php if ($_SESSION['isManager']){ ?>
                        <li><a href="equipment_edit.php">Novo equipamento</a></li>
                    <?php }?>
                </ul>
            </li>
            <li>
                <a href="#">Categorias de equipamento</a>
                <ul class="submenu">
                    <li><a href="category.php">Listar categorias de equipamento</a></li>
                    <?php if ($_SESSION['isManager']){ ?>
                        <li><a href="category_edit.php">Nova categoria de equipamento</a></li>
                    <?php }?>
                </ul>
            </li>
            <li>
                <a href="#">Fabricantes</a>
                <ul class="submenu">
                    <li><a href="manufacturer.php">Listar fabricantes</a></li>
                    <?php if ($_SESSION['isManager']){ ?>
                        <li><a href="manufacturer_edit.php">Novo fabricante</a></li>
                    <?php }?>
                </ul>
            </li>
            <li>
                <a href="#">Utilizadores</a>
                <ul class="submenu">
                    <li><a href="user.php">Listar utilizadores</a></li>
                    <?php if ($_SESSION['isManager']){ ?>
                        <li><a href="user_edit.php">Novo utilizador</a></li>
                    <?php }?>
                </ul>
            </li>
            <?php if ($_SESSION['isManager']){ ?>
                <li>
                    <a href="#">Tipos de utilizador</a>
                    <ul class="submenu">
                        <li><a href="userType.php">Listar tipos de utilizador</a></li>
                        <li><a href="userType_edit.php">Novo tipo de utilizador</a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>