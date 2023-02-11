<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request){
        $users = UserResource::collection(User::query()->paginate());
        return Inertia::render("Admin/User/Index")->with(["users" => $users]);
    }
}
