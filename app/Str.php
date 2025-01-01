<?php

namespace App;

use League\CommonMark\Node\Node;
use League\CommonMark\Node\Inline\Text;
use Tempest\Highlight\CommonMark\HighlightExtension;
use League\CommonMark\Node\Inline\AbstractStringContainer;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;

class Str extends \Illuminate\Support\Str
{
    public static function markdown($string, array $options = [], array $extensions = []) : string
    {
        return parent::markdown($string, $options + [
            'default_attributes' => [
                Heading::class => [
                    'id' => fn (Heading $heading) => self::slug(
                        static::childrenToText($heading)
                    ),
                ],
            ],
        ], $extensions + [
            new DefaultAttributesExtension,
            new HighlightExtension,
        ]);
    }

    /**
     * This is a recursive method that will traverse the given
     * node and all of its children to get the text content.
     */
    protected static function childrenToText(Node $node) : string
    {
        $text = '';

        foreach ($node->children() as $child) {
            if ($child instanceof Text) {
                $text .= $child->getLiteral();
            } elseif ($child instanceof AbstractStringContainer) {
                $text .= $child->getLiteral();
            } else {
                $text .= static::childrenToText($child);
            }
        }

        return $text;
    }
}
