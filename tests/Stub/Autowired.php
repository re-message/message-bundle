<?php
/*
 * This file is a part of Message Standard Bundle.
 * This package is a part of Re Message.
 *
 * @link      https://github.com/re-message/message-bundle
 * @link      https://dev.remessage.ru/packages/message-bundle
 * @copyright Copyright (c) 2018-2023 Re Message
 * @author    Oleg Kozlov <h1karo@remessage.ru>
 * @license   Apache License 2.0
 * @license   https://legal.remessage.ru/licenses/message-bundle
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
