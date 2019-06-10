<?php
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(App\Models\ProjectPoint::class, function (Faker $faker) {
    return [
        'project_id' => 1,
        'location' => new Point(5.1031494140625, 52.0946950569013),
        'area' => Geometry::fromJson('{
                "type": "FeatureCollection",
                "features": [{
                    "type": "Feature",
                    "properties": {},
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [
                            [
                                [
                                  5.07843017578125,
                                  52.13348804077147
                                ],
                                [
                                  4.743347167968749,
                                  51.828988363669126
                                ],
                                [
                                  5.16632080078125,
                                  51.520707104039275
                                ],
                                [
                                  5.69366455078125,
                                  51.65211086156918
                                ],
                                [
                                  5.31463623046875,
                                  51.96965372996562
                                ],
                                [
                                  5.0921630859375,
                                  52.13685974852633
                                ],
                                [
                                  5.07843017578125,
                                  52.13348804077147
                                ]
                              ]
                        ]
                    }
                }]
            }'),
        'category' => 'eten en drinken',
        'name' => $faker->name,
        'information' => $faker->text(25),
    ];
});