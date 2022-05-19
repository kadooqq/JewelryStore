<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/core.php");

$errors = array_merge(ProductActions::createProduct(), ProductActions::editProduct());

$isEdit = false;
if ($_REQUEST["action"] == "edit") {
    $isEdit = true;
    $editing = ProductActions::getProductById($_REQUEST["id"]);
}
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/navbar.php"); ?>
<body class="d-flex flex-column min-vh-100">
<div class="d-flex justify-content-center align-items-center container mt-5">
    <form enctype="multipart/form-data" class="d-flex flex-column justify-content-center align-items-center"
          style="width: 100%" method="post">

        <div class="form-group col-md-6 mt-3 mb-5">
            <h2>Товар</h2>
        </div>

        <div class="form-group col-md-6 my-3">
            <label for="inputImage">Изображение</label>
            <input class="form-control" name='image' type="file" id="inputImage" accept="image/*"
                value=<?php if (!empty($_POST["image"])) :?><?=htmlspecialchars($_POST["image"])?>
                  <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['image'])?>
                  <?php else:?>""<?php endif;?>>

            <?php if (array_key_exists("image_err", $errors)) : ?>
                <label for="inputImage" class="alert alert-danger container-fluid"><?= $errors['image_err'] ?></label>
            <?php endif; ?>

        </div>

        <div class="form-group col-md-6 my-3">
            <label for="inputName">Название</label>
            <input type="text" class="form-control" name="name" id="inputName"
                   value=<?php if (!empty($_POST["name"])) :?><?=htmlspecialchars($_POST["name"])?>
                     <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['name'])?>
                     <?php else:?>""<?php endif;?>
            >

            <?php if (array_key_exists("product_name_err", $errors)) : ?>
                <label for="inputName"
                       class="alert alert-danger container-fluid"><?= $errors['product_name_err'] ?></label>
            <?php endif; ?>

        </div>
        <div class="form-group col-md-6 my-3">
            <label for="selectMaterial">Материал</label>
            <select class="form-control" name='main_material_id' id="selectMaterial">

                <?php
                $materials = MaterialActions::getAllMaterials();
                for ($i = 0; $i < count($materials); $i++) { ?>
                    <option <?php
                    if (!empty($_POST["main_material_id"]) && $materials[$i]['material_id'] == htmlspecialchars($_POST['main_material_id'])
                        || (empty($_POST["main_material_id"]) && htmlspecialchars($_REQUEST['action']) == 'edit' && $materials[$i]['material_id'] == $editing['main_material_id'])) : ?>
                        selected="selected"
                    <?php endif; ?>
                            value="<?= htmlspecialchars($materials[$i]['material_id']) ?>"><?= htmlspecialchars($materials[$i]['name'] . " " . $materials[$i]['sample']) ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group col-md-6 my-3">
            <label for="inputDescription">Описание</label>
            <textarea type="text" name='description' class="form-control"
                      id="inputDescription"><?php
                if (!empty($_POST["description"])) :?><?=htmlspecialchars($_POST["description"])?><?php
                elseif ($isEdit) :?><?= htmlspecialchars($editing['description'])?><?php
                endif;?></textarea>
        </div>
        <div class="form-group col-md-6 my-3">
            <label for="inputCost">Стоимость</label>
            <input type="number" min="0" name='cost' class="form-control" id="inputCost"
                   value=<?php if (!empty($_POST["cost"])) :?><?=htmlspecialchars($_POST["cost"])?>
                   <?php elseif ($isEdit) :?><?= htmlspecialchars($editing['cost'])?>
                   <?php else:?>"0"<?php endif;?>>
            <?php if (array_key_exists("cost_err", $errors)) { ?>
                <label for="inputCost" class="alert alert-danger container-fluid"><?= $errors['cost_err'] ?></label>
            <?php } ?>
        </div>
        <div class="form-group col-md-6 my-3 d-flex justify-content-between">
            <?php if ($_REQUEST["action"] == "create") { ?>
                <input type="hidden" name="action" value="create">
                <div class="btn-group container-fluid mt-5 container-fluid">
                    <input type="submit" class="btn col-md-2 btn-success" value="Создать">
                    <input type="reset" class="btn btn-outline-dark col-md-2" value="Отмена">
                </div>
            <?php } else if ($_REQUEST["action"] == "edit") { ?>
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?= htmlspecialchars($editing['product_id']) ?>">
                <div class="btn-group container-fluid mt-5 container-fluid">
                    <input type="submit" class="btn col-md-2 btn-success" value="Изменить">
                    <input type="reset" class="btn btn-outline-dark col-md-2" value="Отмена">
                </div>
            <?php } ?>
        </div>
    </form>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/footer.php"); ?>
</body>
