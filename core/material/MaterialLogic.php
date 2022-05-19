<?php

class MaterialLogic
{
    public static function createMaterial($name, $sample, $image): array{
        $errors = [];
        if(empty($name)){
            $errors['material_name_err'] = "Не указано название материала.";
        }
        if(empty($image)){
            $errors['image_err'] = "Пожалуйста, загрузите изображение.";
        }
        if(empty($errors)){
            MaterialTable::create($name, $sample, $image);
        }
        return $errors;
    }

    public static function getAllMaterials(): array{
        return MaterialTable::getAll();
    }

    public static function getMaterialById($id): array{
        return MaterialTable::getById($id);
    }

    public static function deleteMaterial($id): array{
        $errors = [];
        try {
            MaterialTable::delete($id);
        }
        catch (PDOException $e) {
            $errors['delete_err'] = "Невозможно удалить материал, так как он указан в товаре.";
            return $errors;
        }
        return [];
    }

    public static function editMaterial($id, $name, $sample, $image): array
    {
        $errors = [];
        if(empty($name)){
            $errors['material_name_err'] = "Не указано название материала";
        }
        if(empty($errors)){
            MaterialTable::edit($id, $name, $sample, $image);
        }
        return $errors;
    }
}