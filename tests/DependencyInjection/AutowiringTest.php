<?php
/*
 * This file is a part of Relations Messenger Message Standard Bundle.
 * This package is a part of Relations Messenger.
 *
 * @link      https://github.com/relmsg/message-bundle
 * @link      https://dev.relmsg.ru/packages/message-bundle
 * @copyright Copyright (c) 2018-2022 Relations Messenger
 * @author    Oleg Kozlov <h1karo@relmsg.ru>
 * @license   Apache License 2.0
 * @license   https://legal.relmsg.ru/licenses/message-bundle
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RM\Bundle\MessageBundle\Tests\DependencyInjection;

use RM\Bundle\MessageBundle\Tests\Stub\Autowired;
use RM\Standard\Message\Format\CacheableMessageFormatter;
use RM\Standard\Message\Format\JsonMessageFormatter;
use RM\Standard\Message\Serializer\ChainMessageSerializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Oleg Kozlov <h1karo@relmsg.ru>
 */
class AutowiringTest extends WebTestCase
{
    public function testAutowiring(): void
    {
        self::bootKernel();
        $autowired = self::getContainer()->get(Autowired::class);

        $formatter = $autowired->getFormatter();
        $this->assertInstanceOf(CacheableMessageFormatter::class, $formatter);
        $this->assertInstanceOf(JsonMessageFormatter::class, $formatter->getFormatter());

        $serializer = $autowired->getSerializer();
        $this->assertInstanceOf(ChainMessageSerializer::class, $serializer);
    }
}
