<?php

use CodeDelivery\Entities\Category;
use CodeDelivery\Entities\Cupom;
use CodeDelivery\Entities\Product;
use Illuminate\Database\Seeder;

class CupomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cupom::class, 10)->create();
    }
}
