<?php


namespace PhPhoneticIndexing\Language;


class French extends RegexIndexingLanguageAbstract {

    private const FRENCH_CHARACTERS_MAP = [

    ];

    protected function getCharactersMap(): array {
        return self::FRENCH_CHARACTERS_MAP;
    }
}