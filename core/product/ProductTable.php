<?php

class ProductTable
{
    public static function create($name, $main_material_id, $description, $cost, $image){
        $query = DatabaseConnection::prepare("INSERT INTO `product` (`name`, `main_material_id`, `description`, `cost`, `image`) VALUES (:name, :main_material_id, :description, :cost, :image)");
        $query->bindValue(":name", $name, PDO::PARAM_STR);
        $query->bindValue(":main_material_id", $main_material_id, PDO::PARAM_INT);
        $query->bindValue(":description", $description, PDO::PARAM_STR);
        $query->bindValue(":cost", $cost, PDO::PARAM_INT);
        $query->bindValue(":image", $image, PDO::PARAM_STR);

        if(!$query->execute()){
            throw new PDOException("error adding product");
        }
    }

    public static function getAll(): array{
        $query = DatabaseConnection::prepare("SELECT product_id, product.name as name, description, cost, product.image as image, main_material_id, material.name as material_name, sample from `product` JOIN `material` ON main_material_id = material_id");
        $query->execute();

        return $query->fetchAll();
    }

    public static function delete($product_id)
    {
        $query = DatabaseConnection::prepare("DELETE FROM `product` WHERE `product_id`=:product_id");
        $query->bindValue(":product_id", $product_id, PDO::PARAM_INT);

        if(!$query->execute()){
            throw new PDOException("error editing product");
        }
    }

    public static function edit($product_id, $name, $main_material_id, $description, $cost, $image)
    {
        $query = DatabaseConnection::prepare("UPDATE `product` SET `name` = :name, `main_material_id` = :main_material_id, `description` = :description, `cost` = :cost, `image` = :image WHERE `product_id` = :product_id");
        $query->bindValue(":name", $name, PDO::PARAM_STR);
        $query->bindValue(":main_material_id", $main_material_id, PDO::PARAM_INT);
        $query->bindValue(":description", $description, PDO::PARAM_STR);
        $query->bindValue(":cost", $cost, PDO::PARAM_INT);
        $query->bindValue(":image", $image, PDO::PARAM_STR);
        $query->bindValue(":product_id", $product_id, PDO::PARAM_INT);

        if(!$query->execute()){
            throw new PDOException("error editing product");
        }
    }

    public static function getById($product_id) : array{
        $query = DatabaseConnection::prepare('SELECT * from `product` where `product_id` = :product_id');
        $query->bindValue(":product_id", $product_id, PDO::PARAM_INT);
        $query->execute();

        $data = $query->fetchAll();

        if(!count($data)){
            return [];
        }

        return $data[0];
    }
}