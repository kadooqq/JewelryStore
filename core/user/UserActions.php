<?php

class UserActions
{
    public static function signUp(): array
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return [];
        }

        $login = $_POST['login'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        $errors = UserLogic::signUp($login, $password, $repeatPassword);

        if (empty($errors)) {
            $_SESSION['login_user'] = $login;
            header("Location: /");
            die();
        }

        return $errors;
    }

    public static function logIn(): array
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return [];
        }

        $login = $_POST['login'];
        $password = $_POST['password'];

        $errors = UserLogic::logIn($login, $password);

        if (empty($errors)) {
            $_SESSION['login_user'] = $login;
            header("Location: /");
            die();
        }

        return $errors;
    }
}