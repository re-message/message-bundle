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

namespace RM\Bundle\MessageBundle;

use RM\Bundle\MessageBundle\DependencyInjection\Compiler\SerializerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class MessageBundle extends Bundle
{
    public const NAME = 'relmsg_message';

    public const SERIALIZER_TAG = self::NAME . '.serializer';

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new SerializerCompilerPass());
    }
}
