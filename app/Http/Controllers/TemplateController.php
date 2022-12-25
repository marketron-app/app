<?php

namespace App\Http\Controllers;

use App\Http\Requests\Templates\IndexTemplatesRequest;
use App\Http\Resources\Templates\TemplateResource;
use App\Services\Template\TemplateService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TemplateController extends Controller
{
    public function __construct(private TemplateService $templateService)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(IndexTemplatesRequest $request): AnonymousResourceCollection
    {
        return TemplateResource::collection($this->templateService->index($request->validated('page'), $request->validated('perPage')));
    }
}
