<?php

/*
 * This file is part of Message Standard Bundle.
 *
 * (c) 2018-present Re Message
 *     Oleg Kozlov <h1karo@remessage.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://dev.remessage.ru/packages/message-bundle
 * https://github.com/re-message/message-bundle
 */

namespace RM\Bundle\MessageBundle\Tests\DependencyInjection;

use RM\Bundle\MessageBundle\Tests\Stub\Autowired;
use RM\Standard\Message\Format\JsonMessageFormatter;
use RM\Standard\Message\Serializer\DelegatingMessageSerializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 *
 * @internal
 */
class AutowiringTest extends WebTestCase
{
    public function testAutowiring(): void
    {
        self::bootKernel();
        $autowired = self::getContainer()->get(Autowired::class);

        $formatter = $autowired->getFormatter();
        self::assertInstanceOf(JsonMessageFormatter::class, $formatter);

        $serializer = $autowired->getSerializer();
        self::assertInstanceOf(DelegatingMessageSerializer::class, $serializer);
    }
}
