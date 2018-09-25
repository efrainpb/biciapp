<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \Illuminate\Support\Facades\DB::table('categories')->insert([
            ['id'=>1,'label'=>'Luces'],
            ['id'=>2,'label'=>'Frenos'],
            ['id'=>3,'label'=>'Canastas'],
            ['id'=>4,'label'=>'Bocinas'],
            ['id'=>5,'label'=>'Asientos']
        ]);

        \Illuminate\Support\Facades\DB::table('countries')->insert([
            ['id'=>1,'name'=>'Mexico'],
            ['id'=>2,'name'=>'Argentina'],
            ['id'=>3,'name'=>'Brazil'],
            ['id'=>4,'name'=>'USA'],
            ['id'=>5,'name'=>'Alemania']
        ]);

        \Illuminate\Support\Facades\DB::table('producers')->insert([
            ['id'=>1,'name'=>'Bennoto'],
            ['id'=>2,'name'=>'Trek'],
            ['id'=>3,'name'=>'Scott']
        ]);

        \Illuminate\Support\Facades\DB::table('bicycle_accessories')->insert([
            ['id'=>1,'sku'=>'KU12K99','description'=>'Luces fluorecentes','category_id'=>1,'country_id'=>1,'producer_id'=>1],
            ['id'=>2,'sku'=>'HUE989X','description'=>'Frenos Delanteros','category_id'=>2,'country_id'=>2,'producer_id'=>2],
            ['id'=>3,'sku'=>'CUE98KK','description'=>'Canasta para niña (Rosa)','category_id'=>3,'country_id'=>3,'producer_id'=>3],
            ['id'=>4,'sku'=>'872DSDW','description'=>'Aciento muy cómodo','category_id'=>5,'country_id'=>4,'producer_id'=>2],
        ]);
    }
}
