<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use DB;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tamamlanan görevleri listenin sonuna ekleyerek gösterim
        $todos = Todo::orderBy('isChecked', 'asc')->get();
        return view('todo.index')->with('todos', $todos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Boş kayıt eklememk için kontrol
        $this->validate($request, [
            'body' => 'required'
        ]);
        
        //Kayıt işlemleri
        $todo = new Todo();
        $todo->body = $request->input('body');
        $todo->isChecked = 0;
        $todo->save();

        return redirect('/todo');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Id ile bul
        $todo = Todo::find($id);
        //Tamamlandı olarak işaretle
        $todo->isChecked = 1;
        //Kaydet
        $todo->save();
        //Anasayfaya yönlendir
        return redirect('/todo');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Kayıdı sil
        $todo = Todo::find($id);
        $todo->delete();

        return redirect('/todo');
    }
}
