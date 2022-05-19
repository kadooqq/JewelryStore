<?php

class UserTable
{
    public static function signUp($login, $password) {
        $query = DatabaseConnection::prepare("INSERT INTO `user` (`login`, `password`) VALUES (:login, :password)");
        $query->bindValue(":login", $login);
        $query->bindValue(":password", $password);

        if(!$query->execute()){
            throw new PDOException("sign up error");
        }
    }

    public static function getUserByLogin($login) : array {
        $query = DatabaseConnection::prepare('SELECT * from `user` where `login` = :login');
        $query->bindValue(":login", $login);
        $query->execute();

        $data = $query->fetchAll();

        if(!count($data)){
            return [];
        }

        return $data[0];
    }
}