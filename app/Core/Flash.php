<?php

namespace App\Core;

class Flash
{
    public static function with($key, $message)
    {
        // Acumula mensagens de cada tipo como array
        if (!isset($_SESSION['flash'][$key])) {
            $_SESSION['flash'][$key] = [];
        }
        $_SESSION['flash'][$key][] = $message;
    }

    public static function get($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $msgs = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $msgs;
        }
        return [];
    }

    public static function has($key)
    {
        return !empty($_SESSION['flash'][$key]);
    }
}
