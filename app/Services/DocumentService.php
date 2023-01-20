<?php

namespace App\Services;

use App\Events\ContentCreated;
use App\Events\DocumentCreated;
use App\Events\DocumentDeleted;
use App\Models\Document;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class DocumentService
{
    public function getDocumentList(): LengthAwarePaginator
    {
        return Document::query()
            ->isActive()
            ->with(['creator' => function ($query) {
                $query->select('id', 'name');
            }])
            ->orderByDesc('id')
            ->paginate(10);
    }
    public function createDocument(User $user, $data): Model|MessageBag
    {
        $data['creator_id'] = $user->id;

        $validator = Validator::make($data, [
            'title' => ['required', 'min:3', 'max:255'],
            'summary' => ['required', 'min:3'],
            'creator_id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $document = $user->document()->create($validator->validated());

        event(new DocumentCreated($document));

        return $document;
    }

    public function deleteDocument(User $user, int $documentId): array
    {
        if(!$document = Document::find($documentId)) {
            return [
                'status' => false,
                'message' => __('messages.document.not_found'),
            ];
        }

        if ($document->creator_id !== $user->id) {
            return [
                'status' => false,
                'message' => __('messages.document.owner_error'),
            ];
        }

        Document::find($documentId)->delete();

        event(new DocumentDeleted($document));

        return [
            'status' => true,
            'message' => __('messages.document.delete'),
        ];
    }

    public function addContentToDocument(Document $document, array $data): Document|MessageBag
    {
        $validator = Validator::make($data, [
            'content' => ['required'],
            'weight' => ['sometimes', 'numeric'],
            'type' => ['required', Rule::in(['text'])],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $document->content()->create($validator->validated());

        event(new ContentCreated());

        return $document;
    }
}
