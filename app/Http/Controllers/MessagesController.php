<?php

namespace App\Http\Controllers;

use DB;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$messages = DB::table('messages')->get();
        $messages = Message::all();
        //return $messages;
        return view("messages.index", compact('messages'));
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
        $message = Message::create($request->all());
        if (auth()->check()){
            $message->user_id = auth()->user()->id;
            $message->save();
            // auth()->user()->messages()->save($message);
        }

        // Redireccionar
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
        //$message = DB::table('messages')->where('id', $id)->first();
        $message = Message::findOrFail($id);
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
        //$message = DB::table('messages')->where('id', $id)->first();
        $message = Message::findOrFail($id);
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
        // Actualizar el mensaje
        /*$message = DB::table('messages')->where('id', $id)->update([
            "nombre" => $request->input('nombre'),
            "email" => $request->input('email'),
            "mensaje" => $request->input('mensaje'),
            "updated_at" => Carbon::now()
        ]);*/

        $message = Message::findOrFail($id);
        $message->update($request->all());
        // Redirecionar
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
        //$message = DB::table('messages')->where('id', $id)->delete();
        $message = Message::findOrFail($id);
        $message->delete();
        // Redirecionar
        return redirect()->route('messages.index');
    }
}
