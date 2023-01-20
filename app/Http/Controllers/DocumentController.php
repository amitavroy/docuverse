<?php

namespace App\Http\Controllers;

use App\Models\Document;
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

    public function index(): Response
    {
        $documents = $this->documentService->getDocumentList();

        return Inertia::render('Document/DocListPage')
            ->with('documents', $documents);
    }

    public function view(Document $document)
    {
        return Inertia::render('Document/DocumentDetailPage')
            ->with('document', $document);
    }

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

    public function delete(Request $request): RedirectResponse
    {
        $resp = $this->documentService->deleteDocument(
            Auth::user(),
            $request->input('document_id')
        );

        return redirect()->route('doc.index');
    }
}
