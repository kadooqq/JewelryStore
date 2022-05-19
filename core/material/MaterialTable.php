<?php

class MaterialTable
{
    public static function create($name, $sample, $image){
        $query = DatabaseConnection::prepare("INSERT INTO `material` (`name`, `sample`, `image`) VALUES (:name, :sample, :image)");
        $query->bindValue(":name", $name, PDO::PARAM_STR);
        $query->bindValue(":sample", $sample, PDO::PARAM_INT);
        $query->bindValue(":image", $image, PDO::PARAM_STR);

        if(!$query->execute()){
            throw new PDOException("error adding material");
        }
    }

    public static function getAll(): array{
        $query = DatabaseConnection::prepare("SELECT * from `material`");
        $query->execute();

        return $query->fetchAll();
    }

    public static function delete($material_id)
    {
        $query = DatabaseConnection::prepare("DELETE FROM `material` WHERE `material_id`=:material_id");
        $query->bindValue(":material_id", $material_id, PDO::PARAM_INT);

        if(!$query->execute()){
            throw new PDOException("error editing material");
        }
    }

    public static function edit($material_id, $name, $sample, $image)
    {
        $query = DatabaseConnection::prepare("UPDATE `material` SET `name` = :name, `sample` = :sample, `image` = :image WHERE `material_id` = :material_id");
        $query->bindValue(":name", $name, PDO::PARAM_STR);
        $query->bindValue(":sample", $sample, PDO::PARAM_INT);
        $query->bindValue(":image", $image, PDO::PARAM_STR);
        $query->bindValue(":material_id", $material_id, PDO::PARAM_INT);

        if(!$query->execute()){
            throw new PDOException("error editing material");
        }
    }

    public static function getById($material_id) : array{
        $query = DatabaseConnection::prepare('SELECT * from `material` where `material_id` = :material_id');
        $query->bindValue(":material_id", $material_id, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetchAll();

        if(!count($data)){
            return [];
        }

        return $data[0];
    }
}