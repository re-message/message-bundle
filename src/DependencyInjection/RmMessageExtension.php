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
