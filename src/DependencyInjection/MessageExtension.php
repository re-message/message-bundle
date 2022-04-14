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

namespace RM\Bundle\MessageBundle\DependencyInjection;

use Exception;
use RM\Standard\Message\Format\MessageFormatterInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Oleg Kozlov <h1karo@relmsg.ru>
 */
class MessageExtension extends Extension
{
    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('formatters.yaml');
        $loader->load('serializers.yaml');

        $formatter = $config['formatter'];
        if ($container->has($formatter)) {
            $container->setAlias(MessageFormatterInterface::class, $formatter);
        } else {
            $container->register(MessageFormatterInterface::class, $formatter);
        }
    }
}
