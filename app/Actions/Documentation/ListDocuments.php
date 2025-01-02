<?php

namespace App\Actions\Documentation;

use App\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class ListDocuments
{
    public function list(string $version) : Collection
    {
        return collect(File::files(resource_path("docs/$version")))
            ->filter(fn (SplFileInfo $file) => '00-introduction' !== $file->getFilenameWithoutExtension())
            ->map(function (SplFileInfo $file) {
                return [
                    'title' => $this->getHeading($file->getPathname()),
                    'slug' => $this->getSlug($file->getFilenameWithoutExtension()),
                    'sections' => $this->getSubheadings($file->getPathname()),
                    'url' => route(
                        'docs.show',
                        ['v1', $this->getSlug($file->getFilenameWithoutExtension())],
                    ),
                ];
            });
    }

    public function getHeading(string $path) : string
    {
        preg_match('/^# (.*)/m', File::get($path), $matches);

        return $matches[1] ?? 'Untitled';
    }

    public function getSubheadings(string $path) : array
    {
        preg_match_all('/^## (.*)/m', File::get($path), $matches);

        return collect($matches[1] ?? [])->map(function (string $heading) {
            return [
                'title' => $heading,
                'slug' => Str::slug($heading),
            ];
        })->toArray();
    }

    public function getSlug(string $filename) : string
    {
        return preg_replace('/^\d+-/', '', Str::slug($filename));
    }
}
