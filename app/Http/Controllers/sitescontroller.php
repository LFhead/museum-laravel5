<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Collection;
use App\User;
use Auth;
use Carbon\Carbon;
use App\UserRecommend;
use Illuminate\Support\Facades\DB;

class sitescontroller extends Controller
{
    //
    public function index(){
        //return $collections;
        return view('home');
    }
    public function collection_list(){
        $collections = Collection::all();
        $title = '藏品列表';
        return view('pages.list',compact('collections','title'));
    }
    public function favorates(){
        $collections = Auth::user()->collections;
        $title = '我的收藏';
        return view('pages.list',compact('collections','title'));
    }
    public function type($type){
        $collections = Collection::where('type', $type)->get();
        $title = $type;
        return view('pages.list',compact('collections','title'));
    }
    public function show($id){
        $collection = Collection::findOrFail($id);
        if (Auth::user()->history()->find($id))
            Auth::user()->history()->updateExistingPivot($id,['updated_at'=>Carbon::now()]);
        else
            Auth::user()->history()->attach($id);
        return view('pages.show',compact('collection'));
    }
    public function clear(){
        Auth::user()->history()->detach();
        return redirect('list');
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
        //dd($input);
        $file=$input['img'];
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        
        $input['img_url']=$destinationPath.$fileName;
        Collection::create($input);
        return redirect('list');
    }
    public function update(){
        //dd($request::all());
        //dd($collection);
        $input = Request::all();
        $collection = Collection::findOrFail($input['id']);
        if(!empty($input->img)){
        $file=$input['img'];
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['error' => 'You may only upload png, jpg or gif.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        
        $input['img_url']=$destinationPath.$fileName;}
        else
        $input['img_url']=$collection['img_url'];
        $collection->update($input);
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

    public function recommend(){
        $dir = dirname(__FILE__);
        exec($dir."/recommend.py");

        $collections = Auth::user()->recommend;
        $title = '猜你喜欢';
        return view('pages.list',compact('collections','title'));
    }

    public function recommendTime(){
        $dir = dirname(__FILE__);
        exec($dir."/recommend.py");
        
        $input = Request::all();
        $title = '路线推荐';
        if(empty($input)){
            $collection = Auth::user()->collections;
            $recommend = Auth::user()->recommend;
            $collections = $collection->merge($recommend);
            return view('pages.recommend',compact('collections','title'));
        }
        else{
            $time = intval(Request::get('time'));

            $collection = Auth::user()->collections;
            $recommend = Auth::user()->recommend;

            $collections = collect();

            foreach ($collection as $data) {
                if ($time >= intval($data->time_rec)) {
                    $collections->push($data);
                    $time = $time - intval($data->time_rec);
                }
            }

            foreach ($recommend as $data) {
                if ($time >= intval($data->time_rec)) {
                    $collections->push($data);
                    $time = $time - intval($data->time_rec);
                }
            }

            $all = Collection::all();
            foreach ($all as $data) {
                if (!($collections->contains($data))) {
                    if($time >= intval($data->time_rec)) {
                        $collections->push($data);
                        $time = $time - intval($data->time_rec);
                    }
                }
            }

            return view('pages.recommend',compact('collections','title'));
        }
    }

    public function userModify(){
        $input = Request::all();
        $user = User::find(Request::get('id'));
        if(!empty($user)) {
            $user->privilege = Request::get('privilege');
            $user->save();
        }
        
        return redirect('user/list');
    }

    public function userDelete() {
        $input = Request::all();
        $user = User::find(Request::get('id'));
        if(!empty($user)) {
            $user->delete();
        }
       
        return redirect('user/list');
    }
}
