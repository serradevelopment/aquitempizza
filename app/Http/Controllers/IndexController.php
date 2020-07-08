<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
class IndexController extends Controller
{
    public function index()
    {
        $configuration = Configuration::first();
    	return view('index')->with(['configuration'=>$configuration]);
    }
}
