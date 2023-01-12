<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\MessageBag;
use Tests\TestCase;

class DocumentSaveTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws BindingResolutionException
     */
    public function it_requires_all_fields()
    {
        $user = User::factory()->create();

        $service = app()->make(DocumentService::class);

        $response = $service->createDocument($user, []);

        $this->assertInstanceOf(MessageBag::class, $response);

        foreach (['title', 'summary'] as $field) {
            $this->assertTrue($response->has($field));
        }
    }

    /** @test
     * @throws BindingResolutionException
     */
    public function it_creates_a_new_document()
    {
        $user = User::factory()->create();

        $service = app()->make(DocumentService::class);

        $response = $service->createDocument($user, [
            'title' => 'Some random title',
            'summary' => 'Some summary',
        ]);

        $this->assertInstanceOf(Document::class, $response);

        $this->assertEquals($user->id, $response->creator_id);
    }
}
