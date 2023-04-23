<?php
/*
 * This file is a part of Message Standard Bundle.
 * This package is a part of Re Message.
 *
 * @link      https://github.com/re-message/message-bundle
 * @link      https://dev.remessage.ru/packages/message-bundle
 * @copyright Copyright (c) 2018-2022 Re Message
 * @author    Oleg Kozlov <h1karo@remessage.ru>
 * @license   Apache License 2.0
 * @license   https://legal.remessage.ru/licenses/message-bundle
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RM\Bundle\MessageBundle\Tests\DependencyInjection;

use RM\Bundle\MessageBundle\Tests\Stub\Autowired;
use RM\Standard\Message\Format\JsonMessageFormatter;
use RM\Standard\Message\Serializer\DelegatingMessageSerializer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class AutowiringTest extends WebTestCase
{
    public function testAutowiring(): void
    {
        self::bootKernel();
        $autowired = self::getContainer()->get(Autowired::class);

        $formatter = $autowired->getFormatter();
        $this->assertInstanceOf(JsonMessageFormatter::class, $formatter);

        $serializer = $autowired->getSerializer();
        $this->assertInstanceOf(DelegatingMessageSerializer::class, $serializer);
    }
}
