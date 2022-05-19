<?php

class UserLogic
{
    public static function signUp($login, $password, $repeatPassword) : array {
        $errors = [];

        $filteredLogin = filter_var($login, FILTER_VALIDATE_EMAIL);

        if (trim($login) === '') {
            $errors['login'] = "Укажите логин";
        } elseif (!$filteredLogin) {
            $errors['login'] = "Пожалуйста, укажите свой email в качестве логина";
        } elseif (!empty(UserTable::getUserByLogin($filteredLogin))) {
            $errors['login'] = "Пользователь с таким логином уже существует";
        }

        if (!empty($password)) {
            if (strlen($password) <= 6) {
                $errors['password'] = "Пароль должен содержать не менее 6 символов";
            }
            elseif(!preg_match("#[0-9]+#", $password)) {
                $errors['password'] = "Пароль должен содержать хотя бы одну цифру";
            }
            elseif(!preg_match("#[A-Z]+#", $password)) {
                $errors['password'] = "Пароль должен содержать хотя бы один заглавный символ";
            }
            else if ($password !== $repeatPassword) {
                $errors['repeatPassword'] = "Пароли не совпадают";
            }
        } else {
            $errors['password'] = "Укажите пароль";
        }

        if (empty($errors)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            UserTable::signUp($filteredLogin, $password);
        }

        return $errors;
    }

    public static function logIn(string $login, string $password) : array {
        $errors = [];

        $filteredLogin = filter_var($login, FILTER_VALIDATE_EMAIL);

        if (!$filteredLogin) {
            $errors['login'] = "Пожалуйста, введите в качестве логина электронную почту";
        }
        else {
            $user = UserTable::getUserByLogin($filteredLogin);
            if (empty($user)) {
                $errors['login'] = "Пользователя с указанным логином не существует";
            }
            elseif (empty($password)) {
                $errors['password'] = "Введите пароль";
            } elseif (!password_verify($password, $user['password'])) {
                $errors['password'] = "Неверно указан пароль";
            }
        }

        return $errors;
    }
}
