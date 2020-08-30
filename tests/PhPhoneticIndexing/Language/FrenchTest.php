<?php


namespace Tests\PhPhoneticIndexing\Language;


use PhPhoneticIndexing\Language\French;
use PhPhoneticIndexing\Language\German;
use PhPhoneticIndexing\String\Normalization;
use PHPUnit\Framework\TestCase;

class FrenchTest extends TestCase {

    /**
     * @param string $word
     * @param string $expectedOutput
     * @dataProvider dataProviderGetPhoneticIndex
     */
    public function testGetPhoneticIndex(string $word, string $expectedOutput) {
        $german = $this->getFrench();
        $output = $german->getPhoneticIndex($word);

        $this->assertEquals($expectedOutput, $output);
    }

    public function dataProviderGetPhoneticIndex(): array {
        $sets = [];

        $sets[] = [
            'word' => 'carabine',
            'expectedOutput' => 'karabyn'
        ];
        $sets[] = [
            'word' => 'aigüe',
            'expectedOutput' => '3ku'
        ];
        $sets[] = [
            'word' => 'enfanter',
            'expectedOutput' => '1f1t3'
        ];
        $sets[] = [
            'word' => 'lentement',
            'expectedOutput' => 'l1tem1'
        ];
        $sets[] = [
            'word' => 'aiment',
            'expectedOutput' => '3m'
        ];
        $sets[] = [
            'word' => 'sérieux',
            'expectedOutput' => 's3rye'
        ];
        $sets[] = [
            'word' => 'sherpa',
            'expectedOutput' => 'j3rba'
        ];
        $sets[] = [
            'word' => 'est',
            'expectedOutput' => '3'
        ];
        $sets[] = [
            'word' => 'espiègle',
            'expectedOutput' => '3sby3kl'
        ];
        $sets[] = [
            'word' => 'ubuesque',
            'expectedOutput' => 'ubu3sk'
        ];
        $sets[] = [
            'word' => 'oublie',
            'expectedOutput' => 'ubly'
        ];
        $sets[] = [
            'word' => 'Aubagne',
            'expectedOutput' => 'obakn'
        ];
        $sets[] = [
            'word' => 'vouvoie',
            'expectedOutput' => 'fufa'
        ];
        $sets[] = [
            'word' => 'oeufs',
            'expectedOutput' => 'ef'
        ];
        $sets[] = [
            'word' => 'transhume',
            'expectedOutput' => 'tr1sum'
        ];
        $sets[] = [
            'word' => 'zigouilleriez',
            'expectedOutput' => 'zykuyery3'
        ];
        $sets[] = [
            'word' => 'aisance',
            'expectedOutput' => '3z1s'
        ];


        return $sets;
    }

    private function getFrench(): French {
        return new French(new Normalization());
    }

}