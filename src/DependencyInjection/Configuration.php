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

use RM\Bundle\MessageBundle\MessageBundle;
use RM\Standard\Message\Format\JsonMessageFormatter;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @author Oleg Kozlov <h1karo@relmsg.ru>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(MessageBundle::NAME);
        $root = $treeBuilder->getRootNode();
        $root
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('formatter')
                    ->defaultValue(JsonMessageFormatter::class)
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
