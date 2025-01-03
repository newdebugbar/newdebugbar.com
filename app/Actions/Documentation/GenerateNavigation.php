<?php

namespace App\Actions\Documentation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class GenerateNavigation
{
    public function generate(string $version) : Collection
    {
        return app(ListDocuments::class)
            ->list($version)
            ->map(function (string $file) {
                $content = File::get($file);

                preg_match('/^---\s*\nSection:\s*(?P<section>.*?)\s*\n---\s*\n\s*#\s*(?P<title>.*?)\s*\n/s', $content, $matches);

                return [
                    'section' => $matches['section'] ?? null,
                    'heading' => $matches['title'] ?? null,
                    'url' => route(
                        'docs.show',
                        ['v1', app(ConvertFilepathToSlug::class)->convert($file)],
                    ),
                ];
            })
            ->groupBy('section');
    }
}
