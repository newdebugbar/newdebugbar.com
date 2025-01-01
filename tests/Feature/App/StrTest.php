<?php

use App\Str;

it('adds an ID to headings', function () {
    expect(Str::markdown('# Hello, World!'))
        ->toContain('<h1 id="hello-world">Hello, World!</h1>');
});

it('highlights code blocks', function () {
    expect(Str::markdown(<<<'MARKDOWN'
```php
echo "Hello, World!";
```
MARKDOWN))
        ->toContain('<pre data-lang="php"');
});
