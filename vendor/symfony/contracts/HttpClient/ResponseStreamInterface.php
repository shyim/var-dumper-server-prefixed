<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient;

/**
 * Yields response chunks, returned by HttpClientInterface::stream().
 *
 * @author Nicolas Grekas <p@tchwork.com>
 *
 * @experimental in 1.1
 */
interface ResponseStreamInterface extends \Iterator
{
    public function key() : \_PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\ResponseInterface;
    public function current() : \_PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\ChunkInterface;
}
