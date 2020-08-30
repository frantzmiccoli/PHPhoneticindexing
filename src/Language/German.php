<?php


namespace PhPhoneticIndexing\Language;


/**
 * Class German
 * @package PhPhoneticIndexing\Language
 *
 * Full reimplementation
 * https://en.wikipedia.org/wiki/Cologne_phonetics
 */
class German extends RegexIndexingLanguageAbstract {

    private const GERMAN_RULES = [
        'remove_diactritics' => '',
        'strip_punctuation' => '',

        // beware the order of rules matters, if we start replacing with
        // simple letters we break rules implying more than one letter

        // leading rules
        '/^c([ahkloqrux])/' => '4$1',
        '/^c([^ahkloqrux])/' => '8$1',

        '/p([^h]|$)/' => '1$1',

        '/[dt]([^csz]|$)/' => '2$1',
        '/([sz])c/' => '${1}8',
        '/c([ahkoqux])/' => '4$1', // meaning also not after s or z

        // 'c' could have been replace initially by 4
        '/(^|[^ckq4])x/' => '${1}48',

        '/[aeijouy]/' => '0',

        '/h/' => '',
        '/b/' => '1',

        '/[fvwp]/' => '3', // 'p' this time before 'h'

        '/[gkq]/' => '4',

        '/l/' => '5',

        '/[mn]/' => '6',

        '/[r]/' => '7',

        '/[a-z]/' => 8, // any character left

        '/([0-9])\1+/' => '$1', // remove duplicates

        '/([^^\s])0/' => '$1', // remove all '0' but the leading one*/

        '/\s/' => '$1' // remove spaces

    ];

    public function getLanguageKey(): string {
        return 'de';
    }

    protected function getReplacementRules(): array {
        return self::GERMAN_RULES;
    }

}