<?php

namespace App\Actions\Documentation;

use App\Str;
use Illuminate\Support\Facades\File;

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
        $file = app(ListDocuments::class)->list($version)->firstWhere(
            fn (string $file) => Str::endsWith($file, "$slug.md")
        );

        throw_if(empty($file), "No file matches \"$slug\"");

        return $file;
    }
}
