<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/core.php");

$errors = UserActions::logIn();
?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/navbar.php"); ?>
<body class="d-flex flex-column min-vh-100">
<div class="d-flex justify-content-center align-items-center container mt-5">
    <main class="form-sign-in mt-5">
        <form method="post" class="rounded mt-5" enctype="multipart/form-data" style="width: 40vw">
            <h1 class="h3 mb-4 fw-normal">Авторизация</h1>
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg" name="login" placeholder="Логин"
                    <?php if (!empty($_REQUEST["login"])) :?> value=<?=htmlspecialchars($_REQUEST["login"])?> <?php endif;?> >
                <?php if (array_key_exists("login", $errors)) : ?>
                    <label for="login"
                           class="alert alert-danger container-fluid"><?= $errors['login'] ?></label>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Пароль"
                    <?php if (!empty($_REQUEST["password"])) :?> value=<?=htmlspecialchars($_REQUEST["password"])?> <?php endif;?>>
                <?php if (array_key_exists("password", $errors)) : ?>
                    <label for="password"
                           class="alert alert-danger container-fluid"><?= $errors['password'] ?></label>
                <?php endif; ?>
            </div>

                <input type="hidden" name="action" value="log-in">
                <button class="w-100 btn btn-success" type="submit">Войти </button>
                <div class="container d-flex justify-content-center mt-3">
                    <a class="btn-outline-dark" href="/sign-up">Зарегистрировать новый аккаунт</a>
                </div>
        </form>
    </main>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/src/components/footer.php"); ?>
</body>
