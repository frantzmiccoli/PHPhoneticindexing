<?php


namespace PhPhoneticIndexing\Language;


interface LanguageInterface {

    public function getPhoneticIndex(string $word): string;

}