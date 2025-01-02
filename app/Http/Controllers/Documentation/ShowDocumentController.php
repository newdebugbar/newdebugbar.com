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
        $navigation = app(ListDocuments::class)->list($version);

        $title = $navigation->firstWhere('slug', $slug)['title'];

        $content = File::get(glob(resource_path("docs/$version/*$slug.md"))[0]);

        return view('docs.show', compact('navigation', 'title', 'slug', 'content'));
    }
}
