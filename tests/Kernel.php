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

namespace RM\Bundle\MessageBundle\Tests;

use Exception;
use Psr\Log\NullLogger;
use RM\Bundle\MessageBundle\MessageBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Class Kernel
 *
 * @author Oleg Kozlov <h1karo@remessage.ru>
 */
class Kernel extends BaseKernel
{
    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    private ?string $testCase;

    public function __construct(string $environment, bool $debug, string $testCase = null)
    {
        parent::__construct($environment, $debug);

        $this->testCase = $testCase;
    }

    /**
     * @inheritDoc
     */
    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new MessageBundle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     * @inheritDoc
     */
    public function getCacheDir(): string
    {
        return sys_get_temp_dir() . '/MessageBundle/cache';
    }

    /**
     * @inheritDoc
     */
    public function getLogDir(): string
    {
        return sys_get_temp_dir() . '/MessageBundle/log';
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $confDir = __DIR__ . '/config';

        $loader->load($confDir . '/{packages}/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}' . self::CONFIG_EXTS, 'glob');

        $testCaseDir = implode('/', [$confDir, $this->testCase]);
        if ($this->testCase && file_exists($testCaseDir) && is_dir($testCaseDir)) {
            $loader->load($testCaseDir . '/*' . self::CONFIG_EXTS, 'glob');
        }
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->register('logger', NullLogger::class);
    }
}
