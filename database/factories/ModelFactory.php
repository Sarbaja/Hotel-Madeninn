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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function(Faker\Generator $faker){
	$faker->addProvider(new Faker\Provider\pt_BR\Address($faker));
	

	return[
		"title" => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
		'slug'=>'',
		"categories" => json_encode($faker->randomElements(array ('2','3','4','6','7'), $faker->numberBetween(1,3))),
		'image'=>'image' => '' ,
		'titleImage'=>'',
		"code" => $faker->regionAbbr.$faker->unique()->numberBetween(1, 10000),
		"order_item" => $faker->unique()->numberBetween(2,20),
		"featured" => rand(0,1),
		"display" =>  rand(0,1),
		"stockQty" => $faker->numberBetween(2,20),
		"originalPrice" => $faker->unique()->numberBetween(700, 1000),
		"discountedPrice" => $faker->unique()->numberBetween(500, 700),
		"description" => $faker->text($faker->numberBetween(200,500)),
		"long_content" => $faker->text($faker->numberBetween(400,800)),
		"created_by" => "admin",
		'created_at'=>$faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
		"updated_by" => ""
	];
});
