<?php

namespace App\Controllers;

use App\Models\Dish;
use App\Models\ListDishes;

class GameGourmetController
{
    public function __construct(
        private ListDishes $dishesOfPasta,
        private ListDishes $dishesWithoutPasta
    )
    {}

    public function think()
    {
        echo "Pense em um prato que você gosta? \n";
        $r = readline("Digite [ok] p/ avancar ou [exit] p/ sair: ");
        if ($r === "sair") $this->finish();
    }

    public function init()
    {
        $this->think();

        echo"O prato que voce pensou e massa? \n";
        $r = readline("Digite [sim] ou [nao]: ");

        if ($r === "sim") $this->takeAGuess($this->dishesOfPasta);

        $this->takeAGuess($this->dishesWithoutPasta);
    }

    public function takeAGuess(ListDishes $dishes)
    {
        $length = count($dishes->getDishes()) - 1;

        for ($count = $length; $count > 0; $count--) {
            $r = $this->askDish($dishes, $count, true);

            if ($r === true) {
                $r = $this->askDish($dishes, $count, false);

                if ($r === true) {
                    $this->iGuessed();
                    break;
                } elseif (($r === true) && ($count === 0)) {
                    $this->addDish($dishes, $count);
                    break;
                }
            }
        }

        if ($count === 0) {
            $r = $this->askDish($dishes, $count, false);
            
            if ($r === true) {
                $this->iGuessed();
            }

            $this->addDish($dishes, $count);
        }
    }

    private function askDish(ListDishes $dishes, int $count, bool $characteristic): bool
    {
        if ($characteristic) {
            echo "O prato que voce pensou e " . $dishes->getDishes()[$count]->getCharacteristic() . " ? \n";
            $r = readline("Digite [sim] ou [nao]: ");
            if ($r === "sim") return true;
        } else {
            echo "O prato que voce pensou e " . $dishes->getDishes()[$count]->getDescription() . " ? \n";
            $r = readline("Digite [sim] ou [nao]: ");
            if ($r === "sim") return true;
        }

        return false;
    }

    private function addDish(ListDishes $dishes, int $indexDish) {
        $dish = $this->createDish($dishes, $indexDish);
        $dishes->setDishes($dish);

        // reinitialize game after add new dish to list
        $this->init();
    }

    private function createDish(ListDishes $dishes, int $indexDish)
    {
        $description = readline("Qual prato voce pensou? ");
        $characteristic = readline("Complete a frase: \n" . $description . " e ____________ mas " . $dishes->getDishes()[$indexDish]->getDescription() . " nao. ");

        return new Dish($description, $characteristic);
    }

    public function iGuessed(): void
    {
        echo "Acertei! \n";
    }

    public function finish(): void
    {
        echo "Obrigado pela sua participação no jogo Gourmet! \n";
    }
}