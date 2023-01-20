<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function images(Request $request){
        return Inertia::render("MyImages/Index");
    }
}
