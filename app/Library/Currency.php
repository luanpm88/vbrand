<?php
namespace App\Library;

class Currency
{
	public static function formatPrice($price)
    {
        $price = number_format($price, 0, '.', ',');
        return "{$price} ₫";
    }
}