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

namespace RM\Bundle\MessageBundle\DependencyInjection\Compiler;

use RM\Bundle\MessageBundle\MessageBundle;
use RM\Standard\Message\Serializer\ChainMessageSerializer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Oleg Kozlov <h1karo@relmsg.ru>
 */
class SerializerCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $chainSerializerDefinition = $container->getDefinition(ChainMessageSerializer::class);
        $services = $container->findTaggedServiceIds(MessageBundle::SERIALIZER_TAG);
        foreach ($services as $serviceId => $tags) {
            if ($serviceId === ChainMessageSerializer::class) {
                continue;
            }

            $reference = new Reference($serviceId);
            $chainSerializerDefinition->addMethodCall('pushSerializer', [$reference]);
        }
    }
}
