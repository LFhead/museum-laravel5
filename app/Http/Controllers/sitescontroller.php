<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Collection;
use App\User;
use Auth;

class sitescontroller extends Controller
{
    //
    public function index(){
        //return $collections;
        return view('home');
    }
    public function collection_list(){
        $collections = Collection::all();
        return view('pages.list',compact('collections'));
    }
    public function favorates(){
        $collections = Collection::all();
        return view('pages.favorates',compact('collections'));
    }
    public function show($id){
        $collection = Collection::findOrFail($id);
        return view('pages.show',compact('collection'));
    }
    public function create(){
        return view('pages.create');
    }
    public function edit($id){
        $collection = Collection::findOrFail($id);
        return view('pages.edit',compact('collection'));
    }
    public function delete(){
        $input = Request::except('_token');
        foreach($input as $id=>$foo){
            echo $id;
            echo "<br/>";
            Collection::destroy($id);
        }
        return redirect('list');
    }
    public function store(){
        $input = Request::all();
        Collection::create($input);
        return redirect('list');
    }
    public function update(Request $request){
        //dd($request::all());
        $collection = Collection::findOrFail($request::get('id'));
        //dd($collection);
        $collection->update($request::except('id'));
        return redirect('list');
    }
    public function user_list(){
        $users = User::all();
        return view('pages.user_list',compact('users'));
    }
    public function like($id){
        Auth::user()->collections()->attach($id);
        //return redirect($_SERVER['REQUEST_URI']);
    }
    public function dislike($id){
        Auth::user()->collections()->detach($id);
        //return redirect($_SERVER['REQUEST_URI']);
    }
}
