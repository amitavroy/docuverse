<?php

namespace Tests\Feature;

use App\Events\DocumentDeleted;
use App\Models\Document;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteDocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_false_if_document_does_not_exist()
    {
        $user = User::factory()->create();

        $documentService = app()->make(DocumentService::class);
        $resp = $documentService->deleteDocument($user, 1);

        $this->assertFalse($resp['status']);
        $this->assertEquals(__('messages.document.not_found'), $resp['message']);
    }

    /** @test */
    public function it_returns_gives_owner_error_when_user_is_someone_else()
    {
        $user = User::factory()->create();
        $document = Document::factory()->create();

        $documentService = app()->make(DocumentService::class);
        $resp = $documentService->deleteDocument($user, $document->id);

        $this->assertFalse($resp['status']);
        $this->assertEquals(__('messages.document.owner_error'), $resp['message']);
    }

    /** @test */
    public function it_deletes_document_with_success()
    {
        $user = User::factory()->create();
        $document = Document::factory()->create([
            'creator_id' => $user->id,
        ]);

        $documentService = app()->make(DocumentService::class);
        $resp = $documentService->deleteDocument($user, $document->id);

        $this->assertTrue($resp['status']);
        $this->assertEquals(__('messages.document.delete'), $resp['message']);
    }

    /** @test */
    public function it_raises_deleted_document_event()
    {
        Event::fake();

        $user = User::factory()->create();
        $document = Document::factory()->create([
            'creator_id' => $user->id,
        ]);

        $documentService = app()->make(DocumentService::class);
        $documentService->deleteDocument($user, $document->id);

        Event::assertDispatched(DocumentDeleted::class);
    }
}
