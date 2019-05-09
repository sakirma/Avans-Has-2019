<?php

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Database\Seeder;

class ProjectPointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Using a Factory to seed data.
        // https://laravel.com/docs/5.8/database-testing#writing-factories

        //factory(App\Models\ProjectPoint::class)->create();
        $this->AddProjectPoint(51.61716386256088, 5.506896972656249);
        $this->AddProjectPoint(51.61716386256088, 5.506896972656249);

        // Example of changing default values of the factory.
        factory(App\Models\ProjectPoint::class)->create([
            'name' => 'testing_lol',
            'information' => 'more information',
            'project_id' => 1
        ]);
    }

    public function AddProjectPoint($lat, $lng)
    {
        factory(App\Models\ProjectPoint::class)->create([
            'location' => new Point($lat, $lng),
            'geo_json' => Geometry::fromJson('{
              "type": "FeatureCollection",
              "features": [
                {
                  "type": "Feature",
                  "properties": {},
                  "geometry": {
                    "type": "Point",
                    "coordinates": [
                      ' . $lat . ',
                      ' . $lng . '
                    ]
                  }
                }
              ]
            }')
        ]);
    }
}
