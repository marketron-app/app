<?php

namespace App\Http\Controllers;

use App\Http\Resources\Templates\TemplateResource;
use App\Models\Template;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $templates = Template::query()->published()->inRandomOrder()->take(5)->get();

        return Inertia::render('Index', [
            'templates' => TemplateResource::collection($templates),
        ]);
    }
}
