<?php

namespace App\Helpers;

class IsbnHelper
{
    public static function generateIsbn13()
    {
        $isbn = '978'; // ISBN-13'ün ilk 3 basamağı her zaman 978 veya 979'dur.
        for ($i = 0; $i < 9; $i++) {
            $isbn .= mt_rand(0, 9);
        }

        $isbn .= self::calculateCheckDigit($isbn);

        return $isbn;
    }

    private static function calculateCheckDigit($isbn)
    {
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int)$isbn[$i] * ($i % 2 === 0 ? 1 : 3);
        }

        $remainder = $sum % 10;
        return $remainder === 0 ? 0 : 10 - $remainder;
    }
}
