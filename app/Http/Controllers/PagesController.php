<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        return view('hello');
    }

    public function datauser() 
    {
        return view('datauser');
    }

    public function datakendaraan(){
        return view('datakendaraan');
    }
}
