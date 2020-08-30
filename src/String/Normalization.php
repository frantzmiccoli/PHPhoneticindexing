<?php


namespace PhPhoneticIndexing\String;


class Normalization {

    public function stripPunctuation(string $text): string {
        // Probably not getting a Turing award for this
        return preg_replace('/[^a-z\d]+/i', ' ', $text);
    }

    /**
     * Diactritics are accentuated characters but with a name that makes you
     * look smarter in pick up lines.
     *
     * @param string $text
     * @return string
     */
    public function removeDiacritics(string $text): string {
        $rules = ':: Any-Latin; :: Latin-ASCII; :: NFD; :: ' .
            '[:Nonspacing Mark:] Remove; :: Lower(); :: NFC;';
        $transliterator = \Transliterator::createFromRules(
            $rules, \Transliterator::FORWARD);
        return $transliterator->transliterate($text);
    }

}