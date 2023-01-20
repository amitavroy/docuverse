<?php

namespace Tests\Feature;

use App\Events\ContentCreated;
use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\MessageBag;
use Tests\TestCase;

class ContentCreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_all_fields()
    {
        $doc = Document::factory()->create();

        $service = app()->make(DocumentService::class);

        $resp = $service->addContentToDocument($doc, []);

        $this->assertInstanceOf(MessageBag::class, $resp);

        foreach (['content', 'type'] as $field) {
            $this->assertTrue($resp->has($field));
        }
    }

    /** @test */
    public function it_creates_a_content()
    {
        $doc = Document::factory()->create();

        $service = app()->make(DocumentService::class);

        $contentData = [
            'weight' => 1,
            'content' => 'This is sample content',
            'type' => 'text',
        ];
        $resp = $service->addContentToDocument($doc, $contentData);

        $this->assertInstanceOf(Document::class, $resp);
        $this->assertDatabaseHas('contents', [
            'document_id' => $resp->id,
            'content' => $contentData['content'],
        ]);
    }

    /** @test */
    public function it_raises_event()
    {
        Event::fake();

        $doc = Document::factory()->create();

        $service = app()->make(DocumentService::class);

        $service->addContentToDocument($doc, [
            'weight' => 1,
            'content' => 'This is sample content',
            'type' => 'text',
        ]);

        Event::assertDispatched(ContentCreated::class);
    }
}
