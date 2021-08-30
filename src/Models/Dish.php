<?php

namespace App\Models;

class Dish
{
    public function __construct(
        private string $description,
        private string $characteristic
    )
    {}

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCharacteristic(): string
    {
        return $this->characteristic;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $characteristic
     */
    public function setCharacteristic(string $characteristic): void
    {
        $this->characteristic = $characteristic;
    }
}