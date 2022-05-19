<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/core.php");

$errors = MaterialActions::deleteMaterial();
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/navbar.php"); ?>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
    <div class="d-flex flex-row my-4 justify-content-between">
        <div class="col-md-6">
            <h2>Список материалов</h2>
        </div>
        <?php if (isset($_SESSION['login_user'])) : ?>
            <a type="button" class="btn btn-success" href=<?= "/material-form?action=create" ?>>Добавить материал
                <i class="bi bi-plus-square"></i></a>
        <?php endif; ?>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th style="width: 2%; text-align: center" scope="col">#</th>
            <th style="width: 25%; text-align: center" scope="col">Фото</th>
            <th style="width: 15%; text-align: center" scope="col">Название</th>
            <th style="width: 25%; text-align: center" scope="col">Проба</th>
            <?php if (isset($_SESSION['login_user'])) : ?>
                <th style="width: 14%; text-align: center" scope="col"></th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $materials = MaterialActions::getAllMaterials();
        for ($i = 0; $i < count($materials); $i++) { ?>
            <tr>
                <th scope="row" style="text-align: center;"> <?= $i + 1 ?> </th>
                <td style="text-align: center;"><img class="img" width="200" height="200"
                                                     src="<?= htmlspecialchars($materials[$i]['image']) ?>"/></td>
                <td style="text-align: center;"><?= htmlspecialchars($materials[$i]['name']) ?></td>
                <td style="text-align: center;"><?= htmlspecialchars($materials[$i]['sample']) ?></td>
                <?php if (isset($_SESSION['login_user'])) : ?>
                    <td style="text-align: center;">
                        <form method="post" class="btn-group container-fluid mt-5">
                            <a type="button" class="btn"
                               style="margin-top: .6rem"
                               href=<?= "/material-form?action=edit&id=" . htmlspecialchars($materials[$i]['material_id']) ?>>
                                <i class="bi bi-pencil" style="font-size: 1.7rem"></i>
                            </a>
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id"
                                   value="<?= htmlspecialchars($materials[$i]['material_id']) ?>">
                            <button type="submit" name="delete" class="btn">
                                <i class="bi bi bi-x" style="font-size: 2.5rem"></i>
                            </button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php } ?>
        </tbody>
        <?php if (array_key_exists("delete_err", $errors)) : ?>
            <label for="delete"
                   class="alert alert-danger container-fluid"><?= $errors['delete_err'] ?></label>
        <?php endif; ?>
    </table>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/footer.php"); ?>
</body>
