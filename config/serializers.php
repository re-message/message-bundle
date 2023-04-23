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

use RM\Bundle\MessageBundle\RmMessageBundle;
use RM\Standard\Message\Serializer\ActionSerializer;
use RM\Standard\Message\Serializer\DelegatingMessageSerializer;
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
        ->tag(RmMessageBundle::SERIALIZER_TAG)
    ;

    $services
        ->alias(MessageSerializerInterface::class, DelegatingMessageSerializer::class)
    ;

    $services
        ->set(DelegatingMessageSerializer::class)
        ->set(ActionSerializer::class)
        ->set(ResponseSerializer::class)
        ->set(ErrorSerializer::class)
    ;
};
