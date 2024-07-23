<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function login(){
        return view('login');
    }
    public function test(){
        return view('test');
    }
}
