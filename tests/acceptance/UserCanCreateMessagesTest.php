<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modelizer\Selenium\SeleniumTestCase;

class UserCanCreateMessagesTest extends SeleniumTestCase
{
    /** @test */
    public function every_user_can_send_messages()
    {
        $this->visit('/');
        $this->click('Crear mensaje');  // Click en enlace
        // Relelnamos campos
        $this->type('Jorge', 'nombre');
        $this->type('jorge@email.com', 'email');
        $this->type('Mensaje de prueba con Selenium', 'mensaje');
        $this->press('save');          // Click en un botón
        
        $this->see('Hemos recibido tu mensaje');
        $this->hold(3);
    }

    /** @test */
    public function registered_user_can_send_messages()
    {
        $this->visit('/');
        $this->click('Login');
        $this->type('josufmc@hotmail.com', 'email');
        $this->type('passw', 'password');
        $this->press('enter');

        $this->click('Crear mensaje');  // Click en enlace
        // Rellenamos campos
        $this->type('Mensaje de usuario registrado con Selenium', 'mensaje');
        $this->press('save');          // Click en un botón
        
        $this->see('Hemos recibido tu mensaje');
        $this->hold(3);
    }
}
