<?php

namespace App\Helpers; // Pastikan namespace ini benar dan sesuai dengan struktur folder

class CalculatorHelper
{
    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function subtract($a, $b)
    {
        return $a - $b;
    }

    // Anda bisa menambahkan metode lain jika diperlukan, misal multiply, divide, dsb.
    // public static function multiply($a, $b)
    // {
    //     return $a * $b;
    // }
}