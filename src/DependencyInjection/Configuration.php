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

use RM\Bundle\MessageBundle\RmMessageBundle;
use RM\Standard\Message\Format\JsonMessageFormatter;
use RM\Standard\Message\Format\MessageFormatterInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class Configuration implements ConfigurationInterface
{
    public const PARAMETER_FORMATTER = 'formatter';

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(RmMessageBundle::NAME);
        $root = $treeBuilder->getRootNode();
        $root->addDefaultsIfNotSet();

        $children = $root->children();

        $formatter = $children->scalarNode(self::PARAMETER_FORMATTER)
            ->defaultValue(JsonMessageFormatter::class)
            ->cannotBeEmpty()
        ;

        $formatter->validate()
            ->ifTrue(fn ($value) => !is_a($value, MessageFormatterInterface::class, true))
            ->thenInvalid($this->getInvalidFormatterMessage())
        ;

        return $treeBuilder;
    }

    protected function getInvalidFormatterMessage(): string
    {
        return sprintf('Formatter MUST implement %s.', MessageFormatterInterface::class);
    }
}
