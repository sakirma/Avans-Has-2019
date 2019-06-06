<?php
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(App\Models\ProjectPoint::class, function (Faker $faker) {
    return [
        'project_id' => 1,
        'location' => new Point(5.287020206451416, 51.68828138589033),
        'area' => null,
        'category' => 'eten en drinken',
        'name' => $faker->name,
        'information' => $faker->text(65000),
    ];
});