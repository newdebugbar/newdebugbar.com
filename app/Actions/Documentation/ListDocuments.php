<?php

namespace App\Actions\Documentation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

class ListDocuments
{
    public function list(string $version) : Collection
    {
        return $this->getFiles($version)
            ->map(function (string $file) {
                $content = File::get($file);

                preg_match('/^---\s*\nSection:\s*(?P<section>.*?)\s*\n---\s*\n\s*#\s*(?P<title>.*?)\s*\n/s', $content, $matches);

                return [
                    'section' => $matches['section'] ?? null,
                    'heading' => $matches['title'] ?? null,
                    'url' => route(
                        'docs.show',
                        ['v1', $this->getSlug($file)],
                    ),
                ];
            })
            ->groupBy('section');
    }

    protected function getFiles(string $version) : Collection
    {
        return collect(
            array_values(
                iterator_to_array(
                    app(Finder::class)
                        ->files()
                        ->in(resource_path("docs/$version"))
                        ->name('*.md')
                        ->sortByName()
                )
            )
        );
    }

    protected function getSlug(string $file) : string
    {
        return str($file)
            ->basename('.md')
            ->replaceMatches('/\d+-/', '')
            ->slug();
    }
}
