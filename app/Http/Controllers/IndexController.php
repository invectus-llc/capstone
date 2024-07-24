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
        return view('dashboard', $user);
    }
    public function login(){
        return view('login');
    }
    public function test(){
        return view('test');
    }
}
