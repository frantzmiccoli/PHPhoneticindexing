<?php


namespace PhPhoneticIndexing\Language;


class French extends RegexIndexingLanguageAbstract {

    private const FRENCH_RULES = [
        // encoding problems require strange solutions
        'ü' => '9',
        'ï' => '8',

        '/([aeiouy])s([aeiouy])/' => '$1z$2',

        '/[éè]/' => '3',
        '/ai/' => '3',
        '/e([rtz]$)/' => '3',
        '/e(r[^3aeiouy])/' => '3$1',
        '/e([tx])/' => '3$1',
        '/^est$/' => '3',
        '/e(s.)/' => '3$1',

        '/au/' => 'o',

        '/oi[e]/' => 'a',

        '/p/' => 'b',

        '/[iu][nm]([^mnaeiouy123])/' => '1$1',
        '/(em)ent$/' => '${1}1',

        '/ent$/' => '-',

        '/en/' => '1',
        '/an([^naeiouy123])/' => '1$1',

        '/o?eu?/' => 'e',

        '/o[nm]([^nmaeiouy123])/' => '2$1',

        '/ou/' => 'u',

        'remove_diactritics' => '',

        '/ph/' => 'f',
        '/v/' => 'f',

        '/s?ch/' => 'j',
        '/sh([^u])/' => 'j$1',
        '/g([ei])/' => 'j$1',


        '/[kg]/' => 'k',
        '/c([^ei])/' => 'k$1',
        '/qu/' => 'k',

        '/ill/' => 'y',
        '/y/' => 'y',
        '/i/' => 'y',

        '/c/' => 's',
        '/ç/' => 's',

        '/[depqrstwxz]$/' => '-',
        '/e$/' => '-',
        '/h/' => '-',

        '/([-123a-z])\1+/' => '$1', // remove duplicates

        '/-/' => '',

        'strip_punctuation' => '',
        '9' => 'u',
        '8' => 'y',
    ];

    private $removeVowels = false;

    public function getLanguageKey(): string {
        return 'fr';
    }

    public function getPhoneticIndex(string $word): string {
        $word = parent::getPhoneticIndex($word);

        if (!$this->removeVowels) {
            return $word;
        }

        $word = $this->multipleReplace('/123aeouy/', '', $word);

        return $word;
    }

    public function setRemoveVowels($removeVowels) {
        $this->removeVowels = $removeVowels;
    }

    protected function getReplacementRules(): array {
        return self::FRENCH_RULES;
    }
}