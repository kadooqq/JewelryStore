<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/JewelryStore/src/components/navbar.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/JewelryStore/core/Routing.php');

$url = key($_GET);

Routing::addRoute("/", "JewelryStore/src/pages/productsPage.php");
Routing::addRoute("/log-in", "JewelryStore/src/pages/logInForm.php");
Routing::addRoute("/sign-up", "JewelryStore/src/pages/signUpForm.php");
Routing::addRoute("/materials", "JewelryStore/src/pages/materialsPage.php");
Routing::addPrivateRoute("/product-form", "JewelryStore/src/pages/productForm.php");
Routing::addPrivateRoute("/material-form", "JewelryStore/src/pages/materialForm.php");

Routing::route("/".$url);
