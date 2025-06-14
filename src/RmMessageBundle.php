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

namespace RM\Bundle\MessageBundle;

use RM\Bundle\MessageBundle\DependencyInjection\Compiler\SerializerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class RmMessageBundle extends Bundle
{
    public const NAME = 'rm_message';

    public const SERIALIZER_TAG = self::NAME . '.serializer';

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new SerializerCompilerPass());
    }
}
