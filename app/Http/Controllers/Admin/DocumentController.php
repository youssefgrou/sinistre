<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    /**
     * Display a document in the browser.
     *
     * @param Document $document
     * @return Response
     */
    public function show(Document $document): Response
    {
        // Check if the file exists in storage
        if (!Storage::disk('public')->exists($document->chemin_fichier)) {
            abort(404, 'Document not found');
        }

        // Get the file content
        $file = Storage::disk('public')->get($document->chemin_fichier);

        // Return the file for display in browser
        return response($file, 200, [
            'Content-Type' => $document->type_mime,
            'Content-Disposition' => 'inline; filename="' . $document->nom . '"'
        ]);
    }

    /**
     * Download a document.
     *
     * @param Document $document
     * @return StreamedResponse
     */
    public function download(Document $document): StreamedResponse
    {
        // Check if the file exists in storage
        if (!Storage::disk('public')->exists($document->chemin_fichier)) {
            abort(404, 'Document not found');
        }

        // Return the file as a download response
        return Storage::disk('public')->download(
            $document->chemin_fichier,
            $document->nom,
            ['Content-Type' => $document->type_mime]
        );
    }
} 