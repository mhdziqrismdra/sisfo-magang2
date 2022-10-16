<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MouController extends Controller
{
    public function index()
    {      
        return view('mou.index');
    }
}
