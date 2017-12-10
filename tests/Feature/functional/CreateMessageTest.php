<?php

namespace Tests\Feature\functional;

//use Tests\TestCase;
use App\User;
use Tests\CreatesApplication;
use Laravel\BrowserKitTesting\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateMessageTest extends TestCase
{
    use CreatesApplication;     // Trait necesario para test funcionales
    use DatabaseTransactions;   // Encierra los tests en transacciones (Más rápido?)
    use DatabaseMigrations;     // Trait para realizar las migraciones en los tests

    public $baseUrl = 'http://mysite.app';
    
    public function setUp(){
        parent::setUp();
    }
    
    /** @test */
    public function a_guest_user_can_send_messages()
    {
        // Teniendo (Vacío)

        // Cuando visitamos messages/create y enviamos el formulario completo
        $this->visit('messages/create');
        $this->type('Jorge', 'nombre'); // $this->type('[value]', '[field]'); 
        $this->type('jorge@email.com', 'email');
        $this->type('Mensaje de prueba', 'mensaje');
        $this->press('Crear');

        // Entionces el mensaje debe estar en la base de datos
        $this->seeInDatabase('messages', [
            'nombre' => 'Jorge',
            'email' => 'jorge@email.com',
            'mensaje' => 'Mensaje de prueba'
        ]);

    }

    /** @test */
    public function a_registered_user_can_send_messages()
    {
        //$this->withoutEvents();   // Evitar eventos de envío de correos, etc...
        
        // Teniendo un usuario registrado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        // Cuando visitamos messages/create y enviamos el formulario completo
        $this->visit('messages/create');
        /*$this->type('Jorge', 'nombre'); // $this->type('[value]', '[field]'); 
        $this->type('jorge@email.com', 'email');*/
        $this->type('Mensaje de usuario registrado', 'mensaje');
        $this->press('Crear');

        // Entionces el mensaje debe estar en la base de datos
        $this->seeInDatabase('messages', [
            'nombre' => null,
            'email' => null,
            'mensaje' => 'Mensaje de usuario registrado',
            'user_id' => $user->id
        ]);

    }
}
