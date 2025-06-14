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

namespace RM\Bundle\MessageBundle\DependencyInjection\Compiler;

use RM\Bundle\MessageBundle\RmMessageBundle;
use RM\Standard\Message\Serializer\DelegatingMessageSerializer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class SerializerCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $delegatingSerializerDefinition = $container->getDefinition(DelegatingMessageSerializer::class);
        $services = $container->findTaggedServiceIds(RmMessageBundle::SERIALIZER_TAG);
        foreach ($services as $serviceId => $tags) {
            if (DelegatingMessageSerializer::class === $serviceId) {
                continue;
            }

            $reference = new Reference($serviceId);
            $delegatingSerializerDefinition->addMethodCall('pushSerializer', [$reference]);
        }
    }
}
