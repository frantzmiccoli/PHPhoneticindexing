<?php


namespace PhPhoneticIndexing\Language;


use PhPhoneticIndexing\String\Normalization;

abstract class RegexIndexingLanguageAbstract implements LanguageInterface {

    private $normalization;

    /**
     * @return string[] keys are the pattern, the values their replacements
     */
    abstract protected function getReplacementRules(): array;


    public function __construct(Normalization $normalization) {
        $this->normalization = $normalization;
    }


    public function getPhoneticIndex(string $word): string {

        $word = strtolower($word);
        $word = preg_replace('/\s/', '', $word);
        if (empty($word)) {
            return '';
        }

        $inOut = $this->getKeysAndValuesFromMap($this->getReplacementRules());
        $ins = array_shift($inOut);
        $outs = array_shift($inOut);

        // We don't use the following line cause if breaks with overlapping
        // patterns like the "dt" at the end of "scheidt"
        // $words = preg_replace($ins, $outs, $word);

        while (!empty($ins)) {
            $in = array_shift($ins);
            $out = array_shift($outs);

            switch ($in) {
                case 'strip_punctuation':
                    $word = $this->normalization->stripPunctuation($word);
                    break;
                case 'remove_diactritics':
                    $word = $this->normalization->removeDiacritics($word);
                    break;
                default:
                    $word = $this->multipleReplace($in, $out, $word);
            }
        }

        return $word;
    }

    protected function multipleReplace(
        string $in,
        string $out,
        string $word
    ): string {
        $oldWord = null;

        while ($word != $oldWord) { // last regex changed something
            $oldWord = $word;

            $isRegularExpression = $in[0] == '/';

            if (!$isRegularExpression) {
                $word = str_replace($in, $out, $word);
                break;
            }

            $word = preg_replace($in, $out, $word);

        }

        return $word;
    }

    private function getKeysAndValuesFromMap(array $map): array {
        $keys = array_keys($map);

        // we make sure values and keys have the same order
        $values = array_map(
            function($key) use ($map): string { return $map[$key]; },
            $keys
        );

        return [$keys, $values];
    }

}