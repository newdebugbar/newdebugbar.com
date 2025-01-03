<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Actions\Documentation\ListDocuments;
use App\Actions\Documentation\ConvertFilepathToSlug;

class RedirectToFirstFileController extends Controller
{
    public function __invoke(?string $version = 'v1') : RedirectResponse
    {
        $firstFile = app(ListDocuments::class)->list($version)->first();

        $slug = app(ConvertFilepathToSlug::class)->convert($firstFile);

        return to_route('docs.show', compact('version', 'slug'));
    }
}
