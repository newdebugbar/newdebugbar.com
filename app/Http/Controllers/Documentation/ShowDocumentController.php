<?php

namespace App\Http\Controllers\Documentation;

use Exception;
use App\Http\Controllers\Controller;
use App\Actions\Documentation\ShowDocument;
use App\Actions\Documentation\ListDocuments;

class ShowDocumentController extends Controller
{
    public function __invoke(string $version, string $slug)
    {
        $navigation = app(ListDocuments::class)->list($version);

        try {
            $document = app(ShowDocument::class)->show($version, $slug);
        } catch (Exception $e) {
            abort(404);
        }

        return view('docs.show', compact('navigation') + [
            'title' => $document['title'],
            'content' => $document['content'],
        ]);
    }
}
