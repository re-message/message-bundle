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

use RM\Bundle\MessageBundle\MessageBundle;
use RM\Standard\Message\Serializer\ActionSerializer;
use RM\Standard\Message\Serializer\ChainMessageSerializer;
use RM\Standard\Message\Serializer\ErrorSerializer;
use RM\Standard\Message\Serializer\MessageSerializerInterface;
use RM\Standard\Message\Serializer\ResponseSerializer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $defaults = $services->defaults();
    $defaults
        ->autowire()
        ->autoconfigure()
        ->private()
    ;

    $services
        ->instanceof(MessageSerializerInterface::class)
        ->tag(MessageBundle::SERIALIZER_TAG)
    ;

    $services
        ->alias(MessageSerializerInterface::class, ChainMessageSerializer::class)
    ;

    $services
        ->set(ChainMessageSerializer::class)
        ->set(ActionSerializer::class)
        ->set(ResponseSerializer::class)
        ->set(ErrorSerializer::class)
    ;
};
