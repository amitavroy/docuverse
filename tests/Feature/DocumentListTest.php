<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class DocumentListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_active_documents_only()
    {
        Document::factory()->inActive()->create();
        Document::factory()->create();

        $documentService = app()->make(DocumentService::class);
        $resp = $documentService->getDocumentList();

        $this->assertEquals(1, $resp->total());
    }

    /** @test */
    public function it_returns_paginated_data()
    {
        Document::factory(5)->create();

        $documentService = app()->make(DocumentService::class);
        $resp = $documentService->getDocumentList();

        $this->assertInstanceOf(LengthAwarePaginator::class, $resp);
    }
}
