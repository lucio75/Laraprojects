<?php

use Illuminate\Database\Seeder;
use LaraCourse\Models\Photo;
class SeedPhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(LaraCourse\Models\Photo::class,30)->create();
    }
}
