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

namespace RM\Bundle\MessageBundle\Tests\Stub;

use RM\Standard\Message\Format\MessageFormatterInterface;
use RM\Standard\Message\Serializer\MessageSerializerInterface;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class Autowired
{
    private MessageSerializerInterface $serializer;
    private MessageFormatterInterface $formatter;

    public function __construct(MessageSerializerInterface $serializer, MessageFormatterInterface $formatter)
    {
        $this->serializer = $serializer;
        $this->formatter = $formatter;
    }

    public function getSerializer(): MessageSerializerInterface
    {
        return $this->serializer;
    }

    public function getFormatter(): MessageFormatterInterface
    {
        return $this->formatter;
    }
}
