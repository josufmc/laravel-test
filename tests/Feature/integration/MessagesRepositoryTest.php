<?php

namespace Tests\Feature\integration;

use App\User;
use App\Message;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
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
    
    
    // Puede ser con test[Método] () o con @test
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

    public function testStoreMessage(){
        // Teniendo un mensaje para guardar
        $request = new Request([
            'nombre' => 'Jorge',
            'email' => 'jorge@email.com',
            'mensaje' => 'Hola, soy Jorge',
        ]);
        // Cuando ejecute el método store
        $this->repo->storeMessage($request);

        // Entonces el mensaje debe aparecer en la base de datos
        $this->assertDatabaseHas('messages', [
            'nombre' => 'Jorge',
            'email' => 'jorge@email.com',
            'mensaje' => 'Hola, soy Jorge',
        ]);
    }


    /** @test */
    public function a_registered_user_can_store_a_message(){
        // Teniendo un usuario registrado y un mensaje
        $user = factory(User::class)->create();

        $request = new Request([
            'mensaje' => 'Hola, soy Jorge',
        ]);

        // Simulamos login del usuario
        $this->actingAs($user);

        // Cuando ejecutemos el método store
        $this->repo->storeMessage($request);

        // El mensaje debe aparece con el usuario relacioanado
        $this->assertDatabaseHas('messages', [
            'nombre' => null,
            'email' => null,    // ** Se usan los campos del propio usuario
            'mensaje' => 'Hola, soy Jorge',
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function it_returns_a_message_by_id(){
        // Teniendo un mensaje en la BD
        $message = factory(Message::class)->create();   // Creamos sólo uno

        // Cuando ejecuto el método findById
        $result = $this->repo->findById($message->id);

        // Entonces debo obtener el mensaje correcto
        $this->assertEquals($message->id, $result->id);
    }


    /** @test */
    public function it_updates_a_message(){
        // Teniendo un mensaje en la BD y datos de actualización
        $message = factory(Message::class)->create();   // Creamos sólo uno
        $request = new Request(['mensaje' => 'Mensaje actualizado']);

        // Cuando ejecuto el método findById
        $result = $this->repo->update($request, $message->id);

        // Entonces en la base de datos debe estar el mensaje actualizado
        $this->assertDatabaseHas('messages', [
            'nombre' => $message->nombre,
            'email' => $message->email,
            'mensaje' => 'Mensaje actualizado'
        ]);
    }


    /** @test */
    public function it_deletes_a_message_by_id(){
        // Teniendo un mensaje en la BD
        $message = factory(Message::class)->create();   // Creamos sólo uno

        $this->assertDatabaseHas('messages', [
            'nombre' => $message->nombre,
            'email' => $message->email,
            'mensaje' => $message->mensaje
        ]);

        // Cuando ejecuto el método destroy
        $result = $this->repo->destroy($message->id);

        // Entonces no dbemos ver el mensaje en la base de datos
        $this->assertDatabaseMissing('messages', [
            'nombre' => $message->nombre,
            'email' => $message->email,
            'mensaje' => $message->mensaje
        ]);
    }
}
