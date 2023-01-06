<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Template\StoreTemplateRequest;
use App\Http\Resources\Admin\Templates\LiteTemplateResource;
use App\Http\Resources\Admin\Templates\TemplateResource;
use App\Models\Template;
use App\Services\Template\TemplateService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TemplateController extends Controller
{
    public function __construct(private TemplateService $templateService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $templates = Template::query()->orderByDesc('id')->paginate(10);

        return Inertia::render('Admin/Template/Index', [
            'templates' => LiteTemplateResource::collection($templates),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Template/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplateRequest $request)
    {
        $template = $this->templateService->storeTemplate($request);

        return redirect(route('templates.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Template  $template
     * @return Response
     */
    public function show(Template $template): Response
    {
        return Inertia::render('Admin/Template/Show', [
            'template' => TemplateResource::make($template),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return redirect(route('templates.index'));
    }
}
