<?php

namespace App\Services;

use App\Events\DocumentCreated;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class DocumentService
{
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
}
