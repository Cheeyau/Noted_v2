<?php

namespace _PhpScoperf97ee63196d1\GuzzleHttp\Psr7;

use _PhpScoperf97ee63196d1\Psr\Http\Message\StreamInterface;
/**
 * Stream decorator that prevents a stream from being seeked.
 *
 * @final
 */
class NoSeekStream implements \_PhpScoperf97ee63196d1\Psr\Http\Message\StreamInterface
{
    use StreamDecoratorTrait;
    public function seek($offset, $whence = \SEEK_SET)
    {
        throw new \RuntimeException('Cannot seek a NoSeekStream');
    }
    public function isSeekable()
    {
        return \false;
    }
}
