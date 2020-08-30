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
            'word' => 'sérieux',
            'expectedOutput' => 's3rie'
        ];
        $sets[] = [
            'word' => 'sherpa',
            'expectedOutput' => 'j3rpa'
        ];
        $sets[] = [
            'word' => 'est',
            'expectedOutput' => '3'
        ];
        $sets[] = [
            'word' => 'espiègle',
            'expectedOutput' => '3spi3gl'
        ];
        $sets[] = [
            'word' => 'aiment',
            'expectedOutput' => '3m'
        ];
        $sets[] = [
            'word' => 'lentement',
            'expectedOutput' => 'l1tem1'
        ];
        $sets[] = [
            'word' => 'ubuesque',
            'expectedOutput' => 'ubu3sk'
        ];
        $sets[] = [
            'word' => 'oublie',
            'expectedOutput' => 'ubli'
        ];

        return $sets;
    }

    private function getFrench(): French {
        return new French(new Normalization());
    }

}