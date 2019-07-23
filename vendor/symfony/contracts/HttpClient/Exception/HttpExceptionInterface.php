<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\Exception;

use _PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\ResponseInterface;
/**
 * Base interface for HTTP-related exceptions.
 *
 * @author Anton Chernikov <anton_ch1989@mail.ru>
 *
 * @experimental in 1.1
 */
interface HttpExceptionInterface extends \_PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\Exception\ExceptionInterface
{
    public function getResponse() : \_PhpScoper5d36eb080763e\Symfony\Contracts\HttpClient\ResponseInterface;
}
