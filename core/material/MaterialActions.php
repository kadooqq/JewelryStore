<?php

class MaterialActions
{
    private static function imgdir_local(): string{
        return $_SERVER['DOCUMENT_ROOT']."/img/materials/";
    }

    private static function imgdir_server(): string{
        return "/img/materials/";
    }

    public static function createMaterial(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="create"){
            return [];
        }

        $name = $_POST['name'];
        $sample = $_POST['sample'];

        $image = "";
        if(!empty(basename($_FILES['image']['name']))){
            $image = self::imgdir_server().basename($_FILES['image']['name']);
        }

        $errors = MaterialLogic::createMaterial($name, $sample, $image);

        if(count($errors)==0){
            header("Location: /materials");
            die();
        }
        else {
            return $errors;
        }
    }

    public static function editMaterial(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="edit"){
            return [];
        }

        $id = $_POST['id'];
        $name = $_POST['name'];
        $sample = $_POST['sample'];

        $image = MaterialLogic::getMaterialById($id)['image'];
        if(!empty(basename($_FILES['image']['name']))){
            $image = self::imgdir_server().basename($_FILES['image']['name']);
        }

        $errors = MaterialLogic::editMaterial($id, $name, $sample, $image);

        if(count($errors)==0){
            header("Location: /materials");
            die();
        }
        else{
            return $errors;
        }
    }

    public static function getAllMaterials(): array{
        return MaterialLogic::getAllMaterials();
    }

    public static function getMaterialById($id): array{
        return MaterialLogic::getMaterialById($id);
    }

    public static function deleteMaterial(): array{
        if($_SERVER['REQUEST_METHOD'] != "POST"){
            return [];
        }

        if($_POST['action']!="delete"){
            return [];
        }

        $material_id = $_POST['id'];

        $errors = MaterialLogic::deleteMaterial($material_id);

        if(count($errors)==0){
            header("Location: /materials");
            die();
        }
        else{
            return $errors;
        }
    }
}