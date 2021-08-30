<?php

require __DIR__."/vendor/autoload.php";

use App\Models\Dish;
use App\Models\ListDishes;
use App\Controllers\GameGourmetController;

//List of dishes
$dishesOfPasta = new ListDishes([new Dish("Lasanha", "")]);
$dishesWithoutPasta = new ListDishes([new Dish("Bolo de Chocolate", "")]);

//controller with default Lists of dishes
$game = new GameGourmetController($dishesOfPasta, $dishesWithoutPasta);

//init game
$game->init();