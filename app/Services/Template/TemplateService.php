<?php

namespace App\Services\Template;

use App\Models\Template;

class TemplateService
{
    public function index($page = 1, $perPage = 20)
    {
        return Template::query()->paginate($perPage, ['*'], 'page', $page);
    }
}
