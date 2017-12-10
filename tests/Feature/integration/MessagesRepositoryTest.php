<?php

namespace Tests\Feature\integration;

use App\Message;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Pagination\Paginator;
use App\Repositories\MessagesRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MessagesRepositoryTest extends TestCase
{
    use DatabaseMigrations; // Trait para limpiar la base de datos cada vez que se hace setUp/tearDown
    
    protected $repo;

    /*public function setUp(){
        parent::setUp();
        $this->repo = new MessagesRepository(); 
    }*/

    /** @before */
    public function sameAsSetUp(){
        $this->repo = new MessagesRepository(); 
    }
    
    
    /** @test */
    public function it_returns_paginated_messages()
    {
        // Given - Teniendo
        // Teniendo más de 20 mensajes
        // $this->seed('MessageTableSeeder');  // *** Usar seeders personalizados para inserción de datos
        $messages = factory(Message::class, 25)->create([
            'created_at' => Carbon::yesterday()
        ]);
        $latestMessage = factory(Message::class)->create([
            'created_at' => Carbon::now()
        ]);
        // When - Cuando
        // Cuando ejecutemos el método getPaginatedMessages
        $result = $this->repo->getPaginatedMessages();
        //dd($result->toArray()); // ** Cuidado con tearDown al usar este comando, igual no se ejecuta con esto.
        // Then - Entonces
        // Entonces debemos obtener 20 mensajes solamente
        $this->assertEquals(20, $result->count());
        // Debemos recibir una instancia del paginador de Laravel
        //dd($result);
        $this->assertTrue($result instanceof LengthAwarePaginator);

        // Verificar mensajes ordednador por fecha de creación
        $this->assertEquals($latestMessage->id, $result->first()->id);

        // Verificar carga de relaciones
        $this->assertTrue($result->first()->relationLoaded('user'));
        $this->assertTrue($result->first()->relationLoaded('note'));
        $this->assertTrue($result->first()->relationLoaded('tags'));
    }
}
