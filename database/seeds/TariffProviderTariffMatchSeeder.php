<?php

use Illuminate\Database\Seeder;

class TariffProviderTariffMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TariffProviderTariffMatch::class, 1000)->create();

        echo "...done\n";
    }
}
