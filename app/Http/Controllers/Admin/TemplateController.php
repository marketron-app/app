<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Template\StoreTemplateRequest;
use App\Http\Requests\Admin\Template\UpdateTemplateImage;
use App\Http\Resources\Admin\Templates\LiteTemplateResource;
use App\Http\Resources\Admin\Templates\TemplateResource;
use App\Models\Template;
use App\Services\Template\TemplateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
     * @return Response
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
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Template/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTemplateRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(StoreTemplateRequest $request): Redirector|RedirectResponse|Application
    {
        $template = $this->templateService->storeTemplate($request);

        return redirect(route('admin.templates.index'));
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
     * @param  UpdateTemplateImage  $request
     * @param  Template  $template
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateTemplateImage $request, Template $template)
    {
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

        return redirect(route('admin.templates.index'));
    }

    public function publish(Template $template)
    {
        $template->update([
            'published_at' => now(),
        ]);

        return redirect(route('admin.templates.show', ['template' => $template->id]));
    }

    public function unpublish(Template $template)
    {
        $template->update([
            'published_at' => null,
        ]);

        return redirect(route('admin.templates.show', ['template' => $template->id]));
    }

    public function updateTemplateImage(UpdateTemplateImage $request, Template $template)
    {
        $this->templateService->updateTemplateImage($template, $request);

        return redirect(route('admin.templates.show', ['template' => $template->id]));
    }

    public function rerenderThumbnail(Template $template){
        $this->templateService->rerenderThumbnail($template);

        return redirect(route('admin.templates.show', ['template' => $template->id]));
    }

}
