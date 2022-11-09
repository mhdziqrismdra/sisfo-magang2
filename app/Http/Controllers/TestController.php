<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        
        
    $date = "2022-02-01";

    $newDate = date('Y-m-d', strtotime($date. ' + 5 years'));

  

    echo $newDate;
    }
}
