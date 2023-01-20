<?php

namespace App\Http\Controllers;

use App\Http\Resources\Images\ImageResource;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(private ImageService $imageService){

    }
    public function images(Request $request){

        $images = $this->imageService->getUserImages(Auth::user())->paginate();
        return Inertia::render("MyImages/Index", [
            "images" => ImageResource::collection($images)
        ]);
    }
}
