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
