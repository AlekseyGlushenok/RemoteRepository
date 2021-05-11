<?php

namespace RemoteRepository\Test;

use PHPUnit\Framework\TestCase;
use RemoteRepository\Extractor\ArrayFirstExtractor;
use RemoteRepository\Extractor\Exception\ExtractorException;
use RemoteRepository\Extractor\Extractor;
use RemoteRepository\Extractor\InnerDataExtractor;
use RemoteRepository\Extractor\JsonExtractor;

class TestDataExtractor extends TestCase
{
    /**
     * @dataProvider innerDataTestProvider
     */
    public function test_innerDataExtractor($data, $key, $expected)
    {
        $extractor = new InnerDataExtractor($key);
        $actual = $extractor->extract($data);

        self::assertEquals($actual, $expected);
    }

    public function innerDataTestProvider(): array
    {
        return [
            [['a' => 'a', 'b' => 'b'], 'a', 'a'],
            [['a' => 'a', 'b' => 'b'], 'c', null],
        ];
    }

    /**
     * @dataProvider arrayFirstTestProvider
     */
    public function test_arrayFirstExtractor($data, $expected): void
    {
        $extractor = new ArrayFirstExtractor();
        $actual = $extractor->extract($data);

        self::assertEquals($actual, $expected);
    }

    public function arrayFirstTestProvider(): array
    {
        return [
            [['a' => 'a', 'b' => 'b', 'c' => 'c'], 'a'],
            ['string', null],
            [[], null]
        ];
    }

    /**
     * @dataProvider jsonExtractorTest
     */
    public function test_jsonDataExtractor($data, $expected): void
    {
        $extractor = new JsonExtractor();
        $actual = $extractor->extract($data);

        self::assertEquals($actual, $expected);
    }

    public function jsonExtractorTest(): array
    {
        return [
            [json_encode(['a' => 'a']), ['a' => 'a']],
            [json_encode('string'), 'string'],
            ['aeueu', null]
        ];
    }

    /**
     * @dataProvider throwExceptionData
     */
    public function test_throwException(Extractor $extractor, $data): void
    {
        $this->expectException(ExtractorException::class);
        $extractor->extract($data);
    }

    public function throwExceptionData()
    {
        return [
            [new ArrayFirstExtractor(null, false), []],
            [new InnerDataExtractor('notExistedKey', null, false), ['existedKey' => 'value']],
            [new InnerDataExtractor('empty', null, false), []],
            [new JsonExtractor(null, false), 'notJsonString']
        ];
    }

    /**
     * @dataProvider chainExtractData
     */
    public function test_chainExtract(Extractor $extractor, $data, $expected): void
    {
        $actual = $extractor->extract($data);

        self::assertEquals($actual, $expected);
    }

    public function chainExtractData(): array
    {
        return [
            [
                new ArrayFirstExtractor(new JsonExtractor(new InnerDataExtractor('a'))),
                [json_encode(['a' => 'a']), 'b'],
                'a'
            ],
            [
                new JsonExtractor(new ArrayFirstExtractor()),
                json_encode(['a', 'b', 'c']),
                'a'
            ]
        ];
    }
}
