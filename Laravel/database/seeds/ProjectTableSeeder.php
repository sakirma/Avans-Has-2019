<?php

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Geometry;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
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

        // Project needs a category.
        DB::table('project_category')->insert([
            'name' => 'lol',
        ]);

        factory(App\Models\Project::class)->create();

        // Example of changing default values of the factory.
        factory(App\Models\Project::class)->create([
            'name' => 'Abigail',
        ]);
    }
}
