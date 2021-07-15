<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['kareem', 'ahmad', 'mom'];
        foreach ( $clients as  $client){
            \App\Client::create([

                'name' => $client,
                'phone' => '05999999',
                 'address' => 'gaza',
            ]);
        }
    }
}
