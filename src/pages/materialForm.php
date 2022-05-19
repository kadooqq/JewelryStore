<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/core.php");

$errors = array_merge(MaterialActions::createMaterial(), MaterialActions::editMaterial());

$isEdit = false;

if ($_REQUEST["action"] == "edit") {
    $isEdit = true;
    $editing = MaterialActions::getMaterialById($_REQUEST["id"]);
}
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/navbar.php"); ?>
<body class="d-flex flex-column min-vh-100">
<div class="d-flex justify-content-center align-items-center container mt-5">
    <form enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center"
          style="width: 100%" method="post">
        <div class="form-group col-md-6 mt-3 mb-5">
            <h2>Материал</h2>
        </div>
        <div class="form-group col-md-6 my-3">
            <label for="inputImage">Изображение</label>
            <input class="form-control" type="file" id="inputImage" name="image" accept="image/*"
                   value=<?php if (!empty($_POST["image"])) :?><?=htmlspecialchars($_POST["image"])?>
                   <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['image'])?>
                   <?php else:?>""<?php endif;?>
            >
            <?php if (array_key_exists("image_err", $errors)) : ?>
                <label for="inputImage"
                       class="alert alert-danger container-fluid"><?= $errors['image_err'] ?></label>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-6 my-3">
            <label for="inputMaterialName">Название</label>
            <input type="text" class="form-control" id="inputMaterialName" name="name"
                   value=<?php if (!empty($_POST["name"])) :?><?=htmlspecialchars($_POST["name"])?>
                   <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['name'])?>
                   <?php else:?>""<?php endif;?>
            >
            <?php if (array_key_exists("material_name_err", $errors)) : ?>
                <label for="inputMaterialName"
                       class="alert alert-danger container-fluid"><?= $errors['material_name_err'] ?></label>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-6 my-3">
            <label for="inputMaterialSample">Проба</label>
            <input type="number" min="0" class="form-control" id="inputMaterialSample" name="sample"
                   value=<?php if (!empty($_POST["sample"])) :?><?=htmlspecialchars($_POST["sample"])?>
                   <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['sample'])?>
                   <?php else:?>"0"<?php endif;?>
            >
        </div>
        <div class="form-group col-md-6 my-3 d-flex justify-content-between">
            <?php if ($_REQUEST["action"] == "create") : ?>
                <input type="hidden" name="action" value="create">
                <div class="btn-group container-fluid mt-5 container-fluid">
                    <input type="submit" class="btn col-md-2 btn-success" value="Создать">
                    <input type="reset" class="btn btn-outline-dark col-md-2" value="Отмена">
                </div>
            <?php elseif ($_REQUEST["action"] == "edit") : ?>
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= $editing['material_id'] ?>">
                <div class="btn-group container-fluid mt-5 container-fluid">
                    <input type="submit" class="btn col-md-2 btn-success" value="Изменить">
                    <input type="reset" class="btn btn-outline-dark col-md-2" value="Отмена">
                </div>
            <?php endif; ?>
        </div>
    </form>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/footer.php"); ?>
</body>
