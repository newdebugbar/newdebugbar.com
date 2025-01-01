<?php

namespace App\Http\Controllers\Documentation;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Actions\Documentation\ListDocuments;

class ListDocumentsController extends Controller
{
    public function __invoke() : View
    {
        $navigation = app(ListDocuments::class)->list();

        $content = File::get(resource_path('docs/00-introduction.md'));

        return view('docs.index', compact('navigation', 'content'));
    }
}
