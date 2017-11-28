<?php

namespace Tests\Feature\unit;

//use Tests\TestCase;           // Laravel
use PHPUnit\Framework\TestCase; // PHPUnit
use App\Http\Controllers\MessagesController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessagesControllerTest extends TestCase
{
    protected $messagesRepository;
    protected $view;
    protected $controller;
    protected $redirect;
    protected $request;

    public function setUp(){
        $this->messagesRepository = \Mockery::mock('App\Repositories\MessagesRepository');
        $this->view = \Mockery::mock('Illuminate\View\Factory');
        $this->redirect = \Mockery::mock('Illuminate\Routing\Redirector');
        $this->request = \Mockery::mock('Illuminate\Http\Request');
        
        $this->controller = new MessagesController($this->messagesRepository, $this->view, $this->redirect);
    }
    
    public function tearDown(){
        \Mockery::close();
    }

    public function testIndex()
    {
        // Verificar que se llame al método getPaginatedMessages sólo una vez
        // Creamos como resultado una cadena 
        $this->messagesRepository->shouldReceive('getPaginatedMessages')->once()->andReturn('paginated_messages');
        // Verificamos que se llama al método make de la View factory
        $this->view
            ->shouldReceive('make')
            ->with('messages.index', ['messages' => 'paginated_messages'])
            ->once();
        // Llamamos al metodo index
        $this->controller->index();
    }

    public function testCreate(){
        $this->view
            ->shouldReceive('make')
            ->with('messages.create')
            ->once();

        // Original method
        $this->controller->create();
    }

    public function testStore(){
        $event = \Mockery::mock('Illuminate\Events\Dispatcher');
        $messageEvent = \Mockery::type('App\Events\MessageWasRecievedEvent');   // Instanceof Un tipo de (Para comprobar tipos)

        $this->messagesRepository
            ->shouldReceive('storeMessage')
            ->with($this->request)
            ->once()
            ->andReturn('saved_message')
            ;
        
        
        //$event->shouldReceive('fire')->once();
        $event->shouldReceive('fire')
            ->once()
            ->with(\Mockery::on(function($param){
                //dd($param);
                //return $param instanceof App\Events\MessageWasRecievedEvent && $param->message == 'saved_message';
                return $param->message == 'saved_message';
            }));

        $this->redirect
            ->shouldReceive('route')
            ->once()
            ->with('messages.create')
            ->andReturn($this->redirect)   // Se devuelve a sí mismo para usar el with
            ;

        $this->redirect
            ->shouldReceive('with')
            ->once()
            ->with('info', 'Mensaje creado!');

        // Original method
        $this->controller->store($this->request, $event);
    }

    public function testShow(){
        $id = 1;
        
        $this->messagesRepository->shouldReceive('findById')->with($id)->once()->andReturn('found_message');

        $this->view
            ->shouldReceive('make')
            ->with('messages.show', ['message' => 'found_message'])
            ->once()
            ;

        // Original method
        $this->controller->show($id);
    }


    public function testEdit(){
        $id = 1;
        
        $this->messagesRepository->shouldReceive('findById')->with($id)->once()->andReturn('found_message');

        $this->view
            ->shouldReceive('make')
            ->with('messages.edit', ['message' => 'found_message'])
            ->once()
            ;

        // Original method
        $this->controller->edit($id);
    }

    public function testUpdate(){
        $id = 1;
        
        $this->messagesRepository->shouldReceive('update')->with($this->request, $id)->once();

        $this->redirect
            ->shouldReceive('route')
            ->once()
            ->with('messages.index')
            ;

        // Original method
        $this->controller->update($this->request, $id);
    }

    public function testDestroy(){
        $id = 1;

        $this->messagesRepository->shouldReceive('destroy')->with($id)->once();

        $this->redirect
            ->shouldReceive('route')
            ->once()
            ->with('messages.index')
            ;

        // Original method
        $this->controller->destroy($id);
    }

    
}
