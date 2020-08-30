<?php


namespace Tests\PhPhoneticIndexing\Language;


use NxBack\Soundex\GetGermanSoundex;
use PhPhoneticIndexing\Language\German;
use PhPhoneticIndexing\String\Normalization;
use PHPUnit\Framework\TestCase;

class GermanTest extends TestCase {

    /**
     * @param string $word
     * @param string $expectedOutput
     * @dataProvider dataProviderGetPhoneticIndex
     */
    public function testGetPhoneticIndex(string $word, string $expectedOutput) {
        $german = $this->_getGerman();
        $output = $german->getPhoneticIndex($word);

        $this->assertEquals($expectedOutput, $output);
    }

    public function dataProviderGetPhoneticIndex(): array {
        $sets = [];

        $sets[] = [
            'word' => 'kartöffeln',
            'expectedOutput' => '472356'
        ];
        $sets[] = [
            'word' => 'zufällig',
            'expectedOutput' => '8354'
        ];
        $sets[] = [
            'word' => 'kompliziert',
            'expectedOutput' => '4615872'
        ];
        $sets[] = [
            'word' => 'Müller-Lüdenscheidt ',
            'expectedOutput' => '65752682'
        ];
        $sets[] = [
            'word' => 'tschechische',
            'expectedOutput' => '848'
        ];
        $sets[] = [
            'word' => 'tschechische republik',
            'expectedOutput' => '84871154'
        ];
        return $sets;
    }

    private function _getGerman(): German {
        return new German(new Normalization());
    }

}