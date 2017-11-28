<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use App\Events\MessageWasRecievedEvent;
use App\Repositories\IMessagesRepository;
use Illuminate\Events\Dispatcher as Event;
use Illuminate\View\Factory as ViewFactory;
use Symfony\Component\HttpFoundation\Request;
use App\Repositories\CacheMessagesRepository;

class MessagesController extends Controller
{
    
    protected $messagesRepository;
    protected $view;
    protected $redirect;

    public function __construct(IMessagesRepository $messagesRepository, ViewFactory $view, Redirector $redirect){
        $this->messagesRepository = $messagesRepository;
        $this->view = $view;
        $this->redirect = $redirect;
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messagesRepository->getPaginatedMessages();
        return $this->view->make("messages.index", compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view->make('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\
     * Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $message = $this->messagesRepository->storeMessage($request);
        $event->fire(new MessageWasRecievedEvent($message));
        return $this->redirect->route('messages.create')->with('info', 'Mensaje creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = $this->messagesRepository->findById($id);
        return $this->view->make("messages.show", compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->messagesRepository->findById($id);
        return $this->view->make('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->messagesRepository->update($request, $id);
        return $this->redirect->route('messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->messagesRepository->destroy($id);
        return $this->redirect->route('messages.index');
    }
}
