<?php declare(strict_types=1);

namespace GraphQL\Tests;

use GraphQL\Language\AST\Node;
use GraphQL\Language\Printer;
use PHPUnit\Framework\TestCase;

abstract class TestCaseBase extends TestCase
{
    /**
     * Useful to test code with no observable behavior other than not crashing.
     *
     * In contrast to PHPUnit's native method, this lets the test case count towards coverage.
     *
     * @see TestCase::expectNotToPerformAssertions()
     */
    protected function assertDidNotCrash(): void
    {
        $this->addToAssertionCount(1);
    }

    protected static function assertASTMatches(string $expected, ?Node $node): void
    {
        self::assertInstanceOf(Node::class, $node);
        self::assertSame($expected, Printer::doPrint($node));
    }

    /**
     * Just defined so that we can use Rector to prefer assertSame() over assertEquals() everywhere else.
     *
     * Array output may differ between tested PHP versions.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     */
    protected static function assertArrayEquals(array $expected, array $actual): void
    {
        self::assertEquals($expected, $actual);
    }
}
