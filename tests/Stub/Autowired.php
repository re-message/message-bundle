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

namespace RM\Bundle\MessageBundle\Tests\Stub;

use RM\Standard\Message\Format\MessageFormatterInterface;
use RM\Standard\Message\Serializer\MessageSerializerInterface;

/**
 * Class Autowired
 *
 * @package RM\Bundle\MessageBundle\Tests\Stub
 * @author  Oleg Kozlov <h1karo@relmsg.ru>
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
