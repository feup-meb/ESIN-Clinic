<section class="view">

  <h3>Lista de Categorias</h3>
  <?php include('tpl_alert.php'); ?>
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <?php if ($_SESSION['isManager']) { ?>
        <th colspan="2"></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($listaCategorias as $categoria) { ?>
      <tr>
        <td><?= $categoria['nome']; ?></td>
        <td><?= $categoria['descricao']; ?></td>
        <?php if ($_SESSION['isManager']) { ?>
        <td class="delete">
          <form method="post" action="<?= ACT_DIR . 'act_category_edit.php' ?>">
            <button value="<?= $categoria['id'] ?>" type="submit" name="delete" class="list fas fa-trash-alt"></button>
          </form>
        </td>
        <td class="edit">
          <form method="post" action="<?= SITE_ROOT . 'category_edit.php' ?>">
            <button value="<?= $categoria['id'] ?>" type="submit" name="edit" class="list far fa-edit"></button>
          </form>
        </td>
        <?php } ?>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</section>