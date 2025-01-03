<?php

namespace App\Http\Controllers\Documentation;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Actions\Documentation\ListDocuments;
use App\Actions\Documentation\ConvertFilepathToSlug;

class RedirectToFirstFileController extends Controller
{
    public function __invoke(?string $version = 'v1') : RedirectResponse
    {
        try {
            $firstFile = app(ListDocuments::class)
                ->list($version)
                ->firstOrFail();
        } catch (Exception $e) {
            abort(404);
        }

        $slug = app(ConvertFilepathToSlug::class)->convert($firstFile);

        return to_route('docs.show', compact('version', 'slug'));
    }
}
