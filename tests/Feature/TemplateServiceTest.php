<?php

namespace Tests\Feature;

use App\Models\Template;
use App\Services\Template\TemplateService;
use Database\Seeders\TemplateSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class TemplateServiceTest extends TestCase
{
    use RefreshDatabase;
    public function testIndexReturnsFirstPageIfPageIsInvalid()
    {
        // Given
        $page = -1;
        $perPage = 20;
        $templateService = new TemplateService();

        // When
        $templates = $templateService->index($page, $perPage);

        // Then
        $this->assertInstanceOf(LengthAwarePaginator::class, $templates);
        $this->assertEquals(1, $templates->currentPage());
        $this->assertEquals($perPage, $templates->perPage());
    }

    public function testIndexReturnsDefaultPerPageIfPerPageIsInvalid()
    {
        // Given
        $page = 1;
        $perPage = 0;
        $templateService = new TemplateService();

        // When
        $templates = $templateService->index($page, $perPage);

        // Then
        $this->assertInstanceOf(LengthAwarePaginator::class, $templates);
        $this->assertEquals($page, $templates->currentPage());
        $this->assertEquals(15, $templates->perPage());
    }

    public function testIndexReturnsPaginatedTemplates()
    {
        $this->seed(TemplateSeeder::class);
        // Given
        $page = 1;
        $perPage = 20;
        $templateService = new TemplateService();

        // When
        $templates = $templateService->index($page, $perPage);

        // Then
        $this->assertInstanceOf(LengthAwarePaginator::class, $templates);
        $this->assertEquals($page, $templates->currentPage());
        $this->assertEquals($perPage, $templates->perPage());

        // Assert that the returned templates match the ones in the database
        $this->assertSame(Template::all()->toArray(), collect($templates->items())->map->toArray()->all());
    }
}
