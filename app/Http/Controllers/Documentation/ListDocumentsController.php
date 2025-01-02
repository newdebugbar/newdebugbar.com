<?php

namespace App\Http\Controllers\Documentation;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Actions\Documentation\ListDocuments;

class ListDocumentsController extends Controller
{
    public function __invoke(string $version) : View
    {
        $path = resource_path("docs/$version/00-introduction.md");

        if (! File::exists($path)) {
            abort(404);
        }

        $navigation = app(ListDocuments::class)->list($version);

        $content = File::get($path);

        return view('docs.index', compact('navigation', 'content'));
    }
}
