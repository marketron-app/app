<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Images\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function index(){
        $images = Image::query()->paginate();
        return Inertia::render("Admin/Image/Index")->with(["images" => ImageResource::collection($images)]);
    }
}
