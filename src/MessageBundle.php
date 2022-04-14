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

namespace RM\Bundle\MessageBundle;

use RM\Bundle\MessageBundle\DependencyInjection\Compiler\SerializerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Oleg Kozlov <h1karo@relmsg.ru>
 */
class MessageBundle extends Bundle
{
    public const NAME = 'message';
    public const SERIALIZER_TAG = self::NAME . '.serializer';

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new SerializerCompilerPass());
    }
}
