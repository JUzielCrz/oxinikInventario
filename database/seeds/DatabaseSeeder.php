<?php

use Illuminate\Database\Seeder;
use App\Models\Config;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AdminSeeder::class);
        $this->call(ProveedoresSeeder::class);
        $this->call(ClientesSeeder::class);
        // $this->call(ProductosSeeder::class);

        Config::create([
            'name'      => 'Mi empresa',
            'logo'      => 'logo.svg',
            'created_at'     =>  '2020-01-17 13:00:00',
        ]);

    }
}
