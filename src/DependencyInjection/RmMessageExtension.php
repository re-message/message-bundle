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

namespace RM\Bundle\MessageBundle\DependencyInjection;

use Exception;
use RM\Standard\Message\Format\MessageFormatterInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class RmMessageExtension extends Extension
{
    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('formatters.php');
        $loader->load('serializers.php');

        $formatter = $config[Configuration::PARAMETER_FORMATTER];
        if ($container->has($formatter)) {
            $container->setAlias(MessageFormatterInterface::class, $formatter);
        } else {
            $container->register(MessageFormatterInterface::class, $formatter);
        }
    }
}
