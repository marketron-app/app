<?php

namespace App\Services\Template;

use App\Models\Template;

class TemplateService
{
    public function index($page = 1, $perPage = 20){
        $templates = Template::query()->paginate($perPage, ["*"], "page", $page);
        return $templates;
    }
}
