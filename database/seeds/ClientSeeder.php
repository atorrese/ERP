<?php
use App\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Client::class)->create([
            'names'=>'Juana Mariana'
        ]);
        factory(Client::class)->times(19)->create();
    }
}
