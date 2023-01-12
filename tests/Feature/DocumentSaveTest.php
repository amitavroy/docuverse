<?php

namespace Tests\Feature;

use App\Events\DocumentCreated;
use App\Models\Document;
use App\Models\User;
use App\Services\DocumentService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
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

    /** @test */
    public function it_fires_an_event_after_document_save()
    {
        Event::fake();

        $user = User::factory()->create();

        $service = app()->make(DocumentService::class);

        $service->createDocument($user, [
            'title' => 'Some random title',
            'summary' => 'Some summary',
        ]);

        Event::assertDispatched(DocumentCreated::class);
    }

    /** @test */
    public function it_requires_authenticated_user()
    {
        $this->get(route('doc.add'))
            ->assertRedirectToRoute('login');
    }

    /** @test */
    public function it_redirects_after_saving()
    {
        $this->actingAs(User::factory()->create())
            ->post(route('doc.store'), [
                'title' => 'This is title',
                'summary' => 'This is summary',
            ])->assertRedirectToRoute('doc.add');
    }
}
