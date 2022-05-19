<?php

class ProductLogic
{
    public static function createProduct($name, $main_material_id, $description, $cost, $image): array{
        $errors = [];

        if(empty($name)){
            $errors['product_name_err'] = "Не указано название товара.";
        }
        if(empty($cost)){
            $errors['cost_err'] = "Не указана стоимость товара.";
        }
        if(empty($main_material_id) && $main_material_id != "0"){
            $errors['main_material_id_err'] = "Не указан материал.";
        }
        if(empty($image)){
            $errors['image_err'] = "Пожалуйста, загрузите изображение.";
        }
        if(empty($errors)){
            ProductTable::create($name, $main_material_id, $description, $cost, $image);
        }
        return $errors;
    }

    public static function getAllProducts(): array{
        return ProductTable::getAll();
    }

    public static function getProductById($id): array{
        return ProductTable::getById($id);
    }

    public static function deleteProduct($id): array{
        ProductTable::delete($id);
        return [];
    }

    public static function editProduct($id, $name, $main_material_id, $description, $cost, $image): array
    {
        $errors = [];
        if(empty($name)){
            $errors['product_name_err'] = "Не указано название товара.";
        }
        if(empty($cost)){
            $errors['cost_err'] = "Не указана стоимость товара.";
        }
        if(empty($main_material_id) && $main_material_id != "0"){
            $errors['main_material_id_err'] = "Не указан материал.";
        }
        if(empty($errors)){
            ProductTable::edit($id, $name, $main_material_id, $description, $cost, $image);
        }
        return $errors;
    }
}