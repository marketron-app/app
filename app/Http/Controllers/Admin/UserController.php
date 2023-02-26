<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaginationSearchRequest;
use App\Http\Resources\Admin\Users\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(PaginationSearchRequest $request)
    {
        $users = User::query()
            ->when(!empty($request->get('search')), function (Builder $query) use ($request){
                return $query->where(function(Builder $query) use ($request){
                    return $query->where("email", "LIKE", "%". $request->get("search") ."%");
                });
            })
            ->paginate($request->get("perPage"))->withQueryString();

        return Inertia::render('Admin/User/Index')->with(['users' => UserResource::collection($users),'perPage' => $users->perPage(), 'search' => $request->get("search")]);
    }
}
