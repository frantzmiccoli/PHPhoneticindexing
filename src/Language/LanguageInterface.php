<?php


namespace PhPhoneticIndexing\Language;


interface LanguageInterface {

    /**
     * @return string e.g. 'fr', 'de', ...
     */
    public function getLanguageKey(): string;

    public function getPhoneticIndex(string $word): string;

}