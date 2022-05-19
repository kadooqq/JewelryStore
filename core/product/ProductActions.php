<?php

class ProductActions
{
    private static function imgdir_local(): string{
        return $_SERVER['DOCUMENT_ROOT']."/img/products/";
    }

    private static function imgdir_server(): string{
        return "/img/products/";
    }

    public static function createProduct(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="create"){
            return [];
        }

        $name = $_POST['name'];
        $description = $_POST['description'];
        $cost = $_POST['cost'];
        $main_material_id = $_POST['main_material_id'];

        $image = "";
        if(!empty(basename($_FILES['image']['name']))){
            if (!move_uploaded_file($_FILES['image']['tmp_name'], self::imgdir_local().basename($_FILES['image']['name']))) {
                //TODO ошибка
            }
            $image = self::imgdir_server().basename($_FILES['image']['name']);
        }

        $errors = ProductLogic::createProduct($name, $main_material_id, $description, $cost, $image);

        if(count($errors)==0){
            header("Location: /");
            die();
        }
        else {
            return $errors;
        }
    }

    public static function editProduct(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="edit"){
            return [];
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $cost = $_POST['cost'];
        $main_material_id = $_POST['main_material_id'];

        $image = ProductLogic::getProductById($id)['image'];
        if(!empty(basename($_FILES['image']['name']))){
            $image = self::imgdir_server().basename($_FILES['image']['name']);
        }

        $errors = ProductLogic::editProduct($id, $name, $main_material_id, $description, $cost, $image);

        if(count($errors)==0){
            header("Location: /");
            die();
        }
        else{
            return $errors;
        }
    }

    public static function getAllProducts(): array{
        return ProductLogic::getAllProducts();
    }

    public static function getProductById($id): array{
        return ProductLogic::getProductById($id);
    }

    public static function deleteProduct(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="delete"){
            return [];
        }

        $product_id = $_POST['id'];

        $errors = ProductLogic::deleteProduct($product_id);

        if(count($errors)==0){
            header("Location: /");
            die();
        }
        else{
            return $errors;
        }
    }
}