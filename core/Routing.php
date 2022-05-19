<?php

class Routing
{
    private static array $pages;

    private static array $private_pages;

    public static function addRoute($url, $path): void
    {
        self::$pages[$url] = $path;
    }

    public static function addPrivateRoute($url, $path): void {
        self::$private_pages[$url] = $path;
    }

    public static function route($url): void
    {
        $path = self::$pages[$url] ?? '';

        if (file_exists($path)) {
            require $path;
            return;
        }

        $path = self::$private_pages[$url] ?? '';
        if (file_exists($path) && isset($_SESSION['login_user'])) {
            require $path;
            return;
        }

        header("Location: /JewelryStore/");
    }
}