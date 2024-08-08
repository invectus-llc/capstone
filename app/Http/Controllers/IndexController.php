<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function dashboard(Request $user){
        // session(['id' => $id]);
        //Session::put(['sessionId'=>$user->user]);
        // dd($user->session()->get('sessionId'));
        // Session::regenerate();
        // dd($user);
        return view('dashboard', ['userid'=>$user->session()->get('sessionId')]);
    }
    public function login(){
        Session::invalidate();
        // dd(Session::all());
        return view('login');
    }
    public function test(){
        return view('test');
    }
}
