<?php

namespace App\Actions\Documentation;

class ConvertFilepathToSlug
{
    public function convert(string $file) : string
    {
        return str($file)
            ->basename('.md')
            ->replaceMatches('/\d+-/', '')
            ->slug();
    }
}
