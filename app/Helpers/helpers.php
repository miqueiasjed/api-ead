<?php

namespace App\Helpers;

use InvalidArgumentException;

class OrderByHelper
{
    public static function orderBy(string $orderBy): array
    {
        $orderByArray = [];

        foreach (explode(',', $orderBy) as $value) {
            $value = trim($value);

            if (!preg_match("/^(-)?[A-Za-z0-9_]+$/", $value)) {
                throw new InvalidArgumentException('O parâmetro "order_by" não está em um formato válido.');
            }

            $orderByArray[$value] = 'ASC';

            if (strstr($value, '-')) {
                $orderByArray[$value] = 'DESC';
            }
        }

        return $orderByArray;
    }
}
