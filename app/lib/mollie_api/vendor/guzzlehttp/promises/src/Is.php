<?php

namespace _PhpScoperf97ee63196d1\GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     *
     * @return bool
     */
    public static function pending(\_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled or rejected.
     *
     * @return bool
     */
    public static function settled(\_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() !== \_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface::PENDING;
    }
    /**
     * Returns true if a promise is fulfilled.
     *
     * @return bool
     */
    public static function fulfilled(\_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface::FULFILLED;
    }
    /**
     * Returns true if a promise is rejected.
     *
     * @return bool
     */
    public static function rejected(\_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface $promise)
    {
        return $promise->getState() === \_PhpScoperf97ee63196d1\GuzzleHttp\Promise\PromiseInterface::REJECTED;
    }
}
