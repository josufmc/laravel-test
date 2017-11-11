<?php

use App\Message;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();    // Con Eloquent
        for($i=1; $i <= 100; $i++){
            Message::create(array(
                'nombre'     => 'Nombre' . $i,
                'email'    => 'correo' . $i . '@hotmail.com',
                'mensaje' => 'Mensaje ' . $i . ' de prueba',
                'created_at' => Carbon::now()->subDays(100)->addDays($i)
            ));
        }
    }
}
