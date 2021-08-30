<?php

namespace App\Models;

class ListDishes
{
    public function __construct(
        private array $dishes = []
    )
    {}

    /**
     * @return array
     */
    public function getDishes(): array
    {
        return $this->dishes;
    }

    /**
     * @param Dish $dish
     */
    public function setDishes(Dish $dish): void
    {
        array_push($this->dishes, $dish);
    }
}