<?php

namespace App\Service;

use App\Entity\Smartphone;
use Exception;

class PriceCalculatorService
{
    public function calculateTotalPrice(Smartphone $smartphone): int
    {
        $properties = ['getRam', 'getStockage', 'getBrand', 'getModel', 'getStatus'];
        $priceTotal = 0;

        foreach ($properties as $property) {
            $value = $smartphone->$property();
            if (!is_object($value) || !method_exists($value, 'getValue')) {
                throw new Exception("Invalid property or value in smartphone");
            }

            $priceTotal += $value->getValue();
        }

        return $priceTotal;
    }
}
