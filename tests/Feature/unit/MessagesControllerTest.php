<?php

namespace Tests\Feature\unit;

//use Tests\TestCase;           // Laravel
use PHPUnit\Framework\TestCase; // PHPUnit
use App\Http\Controllers\MessagesController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessagesControllerTest extends TestCase
{
    public function testIndex()
    {
        $messagesRepository = \Mockery::mock('App\Repositories\MessagesRepository');
        $controller = new MessagesController($messagesRepository);
        
        // Verificar que se llame al método getPaginated sólo una vez
        $messagesRepository->shouldReceive('getPaginated')->once()->withAnyArgs();

        // Llamamos al metodo index
        $controller->index();

    }

    public function tearDown(){
        \Mockery::close();
    }
}
