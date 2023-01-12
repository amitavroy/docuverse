<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DocumentController extends Controller
{
    public function __construct(
        private readonly DocumentService $documentService
    ) {}

    public function add(): Response
    {
        return Inertia::render('Document/AddDocPage');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->documentService->createDocument(
            Auth::user(),
            $request->all()
        );

        return redirect()->route('doc.add');
    }
}
