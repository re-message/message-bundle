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

namespace RM\Bundle\MessageBundle\DependencyInjection\Compiler;

use RM\Bundle\MessageBundle\RemessageMessageBundle;
use RM\Standard\Message\Serializer\ChainMessageSerializer;
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
        $chainSerializerDefinition = $container->getDefinition(ChainMessageSerializer::class);
        $services = $container->findTaggedServiceIds(RemessageMessageBundle::SERIALIZER_TAG);
        foreach ($services as $serviceId => $tags) {
            if ($serviceId === ChainMessageSerializer::class) {
                continue;
            }

            $reference = new Reference($serviceId);
            $chainSerializerDefinition->addMethodCall('pushSerializer', [$reference]);
        }
    }
}
