<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/core.php");

ProductActions::deleteProduct();
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/navbar.php"); ?>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
    <div class="d-flex flex-row my-4 justify-content-between">
        <div class="col-md-6">
            <h2>Список товаров</h2>
        </div>
        <?php if (isset($_SESSION['login_user'])) :?>
        <a type="button" class="btn btn-success" href=<?= "/product-form?action=create"?>>
            Добавить изделие
            <i class="bi bi-plus-square"></i>
        </a>
        <?php endif;?>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th style="width: 2%; text-align: center" scope="col">#</th>
            <th style="width: 25%; text-align: center" scope="col">Фото</th>
            <th style="width: 15%; text-align: center" scope="col">Название</th>
            <th style="width: 10%; text-align: center" scope="col">Материал</th>
            <th style="width: 25%; text-align: center" scope="col">Описание</th>
            <th style="width: 11%; text-align: center" scope="col">Стоимость</th>
            <?php if (isset($_SESSION['login_user'])) :?>
            <th style="width: 14%; text-align: center" scope="col"></th>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
        <?php
        $products = ProductActions::getAllProducts();
        for ($i = 0; $i < count($products); $i++) { ?>
            <tr>
                <th scope="row" style="text-align: center;"> <?= $i + 1 ?> </th>
                <td style="text-align: center;"><img class="img" width="200" height="200"
                                                     src="<?= htmlspecialchars($products[$i]['image']) ?>"/></td>
                <td style="text-align: center;"><?= htmlspecialchars($products[$i]['name']) ?></td>
                <td style="text-align: center;"><?= htmlspecialchars($products[$i]['material_name']." ".$products[$i]['sample']) ?></td>
                <td style="text-align: center;"><?= htmlspecialchars($products[$i]['description']) ?></td>
                <td style="text-align: center;"><?= htmlspecialchars($products[$i]['cost']) ?></td>
            <?php if (isset($_SESSION['login_user'])) :?>
                <td style="text-align: center;">
                    <form method="post" class="btn-group container-fluid mt-5">
                        <a type="button" class="btn"
                           style="margin-top: 1.2rem"
                           href=<?= "/product-form?action=edit&id=".htmlspecialchars($products[$i]['product_id'])?>>
                            <i class="bi bi-pencil" style="font-size: 1.7rem"></i>
                        </a>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($products[$i]['product_id'])?>">
                        <button type="submit" name="delete" class="btn">
                            <i class="bi bi bi-x" style="font-size: 3rem"></i>
                        </button>
                    </form>
                </td>
            <?php endif;?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/footer.php"); ?>
</body>
