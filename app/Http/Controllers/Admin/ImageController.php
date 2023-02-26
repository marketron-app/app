<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaginationSearchRequest;
use App\Http\Resources\Admin\Images\ImageResource;
use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;

class ImageController extends Controller
{
    public function index(PaginationSearchRequest $request)
    {
        $images = Image::query()->with(['template'])
            ->when(! empty($request->get('search')), function (Builder $query) use ($request) {
                return $query->where(function (Builder $query) use ($request) {
                    return $query->where('url', 'LIKE', '%'.$request->get('search').'%')
                        ->orWhereHas('template', function (Builder $query) use ($request) {
                            return $query->where('identifier', 'LIKE', '%'.$request->get('search').'%');
                        })
                        ->orWhereHas('user', function (Builder $query) use ($request) {
                            return $query->where('email', 'LIKE', '%'.$request->get('search').'%');
                        });
                });
            })
            ->paginate($request->get('perPage'))->withQueryString();

        return Inertia::render('Admin/Image/Index')->with(['images' => ImageResource::collection($images), 'perPage' => $images->perPage(), 'search' => $request->get('search')]);
    }
}
