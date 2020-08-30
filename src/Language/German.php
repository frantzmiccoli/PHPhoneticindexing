<?php


namespace PhPhoneticIndexing\Language;


use PhPhoneticIndexing\String\Normalization;

/**
 * Class German
 * @package PhPhoneticIndexing\Language
 *
 * Full reimplementation
 * https://en.wikipedia.org/wiki/Cologne_phonetics
 */
class German implements LanguageInterface {

    private const CHARACTERS_MAP = [
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

        '/([^^])0/' => '$1' // remove all '0' but the leading one*/
    ];

    private $normalization;

    public function __construct(Normalization $normalization) {
        $this->normalization = $normalization;
    }

    public function getPhoneticIndex(string $word): string {
        $word = strtolower($word);
        $word = $this->normalization->removeDiacritics($word);
        $word = $this->normalization->stripPunctuation($word);
        $word = preg_replace('/\s/', '', $word);

        if (empty($word)) {
            return '';
        }

        $inOut = $this->_getKeysAndValuesFromMap(self::CHARACTERS_MAP);
        $ins = array_shift($inOut);
        $outs = array_shift($inOut);

        // We don't use the following line cause if breaks with overlapping
        // patterns like the "dt" at the end of "scheidt"
        // $words = preg_replace($ins, $outs, $word);

        while (!empty($ins)) {
            $in = array_shift($ins);
            $out = array_shift($outs);
            $word = $this->_multipleReplace($in, $out, $word);
        }

        return $word;
    }

    private function _multipleReplace(
        string $in,
        string $out,
        string $word
    ): string {
        $oldWord = null;
        while ($word != $oldWord) { // last regex changed something
            $oldWord = $word;
            $word = preg_replace($in, $out, $word);
        }

        return $word;
    }

    private function _getKeysAndValuesFromMap(array $map): array {
        $keys = array_keys($map);

        // we make sure values and keys have the same order
        $values = array_map(
            function($key) use ($map): string { return $map[$key]; },
            $keys
        );

        return [$keys, $values];
    }

}