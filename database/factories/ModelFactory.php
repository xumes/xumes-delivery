<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeDelivery\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeDelivery\Entities\Category::class, function (Faker\Generator $faker) {
   return [
       'name' => $faker->word
   ];
});

$factory->define(CodeDelivery\Entities\Product::class, function (Faker\Generator $faker) {
   return [
       'name' => $faker->word,
       'description' => $faker->sentence,
       'price' => $faker->numberBetween(10, 50),
   ];
});

$factory->define(CodeDelivery\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' =>$faker->city,
        'state' => $faker->streetAddress,
        'zipcode' => $faker->postcode
    ];
});

$factory->define(CodeDelivery\Entities\Order::class, function (Faker\Generator $faker) {
    return [
        'client_id'=> rand(1, 10),
        'total' => rand(50, 100),
        'status' => 0,
    ];
});

$factory->define(CodeDelivery\Entities\OrderItem::class, function (Faker\Generator $faker) {
    return [

    ];
});

$factory->define(CodeDelivery\Entities\Cupom::class, function (Faker\Generator $faker) {
    return [
        'code'=>rand(100, 10000),
        'value'=>rand(50, 100)
    ];
});

$factory->define(CodeDelivery\Entities\OAuth::class, function (Faker\Generator $faker) {
    return [
        'id' => 'appid01',
        'secret' => 'secret',
        'name' => 'My mobile app'
    ];
});