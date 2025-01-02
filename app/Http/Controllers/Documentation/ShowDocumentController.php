<?php

namespace App\Http\Controllers\Documentation;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Actions\Documentation\ListDocuments;

class ShowDocumentController extends Controller
{
    public function __invoke(string $version, string $slug) : View
    {
        $directory = resource_path("docs/$version");

        $filePath = data_get(glob("$directory/*$slug.md"), 0);

        if (! File::exists($directory) || empty($filePath)) {
            abort(404);
        }

        $navigation = app(ListDocuments::class)->list($version);

        $title = $navigation->firstWhere('slug', $slug)['title'];

        $content = File::get($filePath);

        return view('docs.show', compact('navigation', 'title', 'slug', 'content'));
    }
}
