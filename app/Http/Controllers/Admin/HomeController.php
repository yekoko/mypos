<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sentinel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getIndex()
    {
        return view('admin.index');
    }
}
