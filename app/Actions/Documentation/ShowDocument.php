<?php

namespace App\Actions\Documentation;

use Exception;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

class ShowDocument
{
    public function show(string $version, string $slug) : array
    {
        $content = File::get(
            $this->getFile($version, $slug)
        );

        preg_match('/^---\s*\nSection:\s*(?P<section>.*?)\s*\n---\s*\n(?P<content>\s*#\s*(?P<title>.*?)\s*\n.*)/s', $content, $matches);

        return [
            'section' => $matches['section'] ?? null,
            'title' => $matches['title'] ?? null,
            'content' => $matches['content'] ?? null,
        ];
    }

    protected function getFile(string $version, string $slug) : ?string
    {
        $file = array_values(
            iterator_to_array(
                app(Finder::class)
                    ->files()
                    ->in($path = resource_path("docs/$version"))
                    ->name($name = "*$slug.md")
            )
        )[0] ?? null;

        if (empty($file)) {
            throw new Exception("No file matches $path/$name");
        }

        return $file;
    }
}
