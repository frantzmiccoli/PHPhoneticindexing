<?php


namespace Tests\PhPhoneticIndexing;


use PhPhoneticIndexing\Exception\LanguageNotFoundException;
use PhPhoneticIndexing\GetPhoneticIndex;
use PHPUnit\Framework\TestCase;

class GetPhoneticIndexTest extends TestCase {

    public function testGetPhoneticIndex() {
        $getPhoneticIndex = $this->getGetPhoneticIndex();

        $index = $getPhoneticIndex->getPhoneticIndex('Hello', 'en');
        $this->assertRegExp('/H\d{3}/i', $index);

        $index = $getPhoneticIndex->getPhoneticIndex('Gunter', 'de');
        $this->assertRegExp('/\d*/', $index);

        $index = $getPhoneticIndex->getPhoneticIndex('Graine', 'fr');
        $this->assertEquals('kr3n', $index);
    }

    public function testMissingLanguage() {
        $getPhoneticIndex = $this->getGetPhoneticIndex();

        $errorCount = 0;
        try {
            $getPhoneticIndex->getPhoneticIndex('Graine', 'zh');
        } catch (LanguageNotFoundException $e) {
            $errorCount += 1;
        }

        $this->assertEquals(1, $errorCount);
    }

    private function getGetPhoneticIndex(): GetPhoneticIndex {
        return new GetPhoneticIndex();
    }

}