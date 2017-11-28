<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\Cache;
use App\Events\MessageWasRecievedEvent;
use App\Repositories\IMessagesRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repositories\CacheMessagesRepository;

class MessagesController extends Controller
{
    
    private $messagesRepository;

    public function __construct(IMessagesRepository $messagesRepository){
        $this->middleware('auth', ['except' => ['create', 'store']]);
        $this->messagesRepository = $messagesRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = $this->messagesRepository->getPaginatedMessages();
        //return view("messages.index", compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\
     * Http\Response
     */
    public function store(Request $request)
    {
        $message = $this->messagesRepository->storeMessage($request);
        event(new MessageWasRecievedEvent($message));
        return redirect()->route('messages.create')->with('info', 'Mensaje creado!');
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
        return view("messages.show", compact('message'));
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
        return view('messages.edit', compact('message'));
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
        return redirect()->route('messages.index');
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
        return redirect()->route('messages.index');
    }
}
