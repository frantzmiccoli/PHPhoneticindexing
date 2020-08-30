<?php


namespace PhPhoneticIndexing;


use PhPhoneticIndexing\Exception\LanguageNotFoundException;
use PhPhoneticIndexing\Language\English;
use PhPhoneticIndexing\Language\French;
use PhPhoneticIndexing\Language\German;
use PhPhoneticIndexing\Language\LanguageInterface;
use PhPhoneticIndexing\Language\RegexIndexingLanguageAbstract;
use PhPhoneticIndexing\String\Normalization;

class GetPhoneticIndex {

    /**
     * @var LanguageInterface[]
     */
    private $languages;

    public function __construct($languages = []) {
        if (!empty($languages)) {
            $this->languages = $languages;
            return;
        }

        $normalization = new Normalization();

        $this->languages = [
            'de' => new German($normalization),
            'en' => new English(),
            'fr' => new French($normalization)
        ];
    }

    public function addLanguage(LanguageInterface $language) {
        $this->languages[$language->getLanguageKey()] = $language;
    }

    public function getPhoneticIndex($word, $languageKey): string {
        if (!array_key_exists($languageKey, $this->languages)) {
            $message = $languageKey . ' is not available';
            throw new LanguageNotFoundException($message);
        }

        $language = $this->languages[$languageKey];

        return $language->getPhoneticIndex($word);
    }

}