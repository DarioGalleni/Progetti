<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {    
        return view('welcome');
    }

}
