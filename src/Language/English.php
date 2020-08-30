<?php


namespace PhPhoneticIndexing\Language;


class English implements LanguageInterface {

    public function getLanguageKey(): string {
        return 'en';
    }

    public function getPhoneticIndex(string $word): string {
        return soundex($word);
    }

}