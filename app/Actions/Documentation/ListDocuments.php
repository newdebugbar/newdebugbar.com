<?php

namespace App\Actions\Documentation;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

class ListDocuments
{
    public function list(string $version) : Collection
    {
        return collect(
            iterator_to_array(
                app(Finder::class)
                    ->files()
                    ->in(resource_path("docs/$version"))
                    ->name('*.md')
                    ->sortByName()
            )
        );
    }
}
