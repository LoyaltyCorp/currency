<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use Closure;
use GlobIterator;

abstract class Iterator
{
    /**
     * Iterate over locales and pass them to closure
     *
     * @param \Closure $closure The closure to run against the instantiated class
     * @param string $directory The directory to scan
     * @param string $interface The interface the class needs to implement
     *
     * @return mixed|null The result of the closure or null
     */
    protected function iterateDirectory(Closure $closure, string $directory, string $interface)
    {
        $classes = new GlobIterator(\sprintf('%s/*.php', \sprintf('%s/%s', __DIR__, $directory)));

        /** @var \SplFileInfo $class */
        foreach ($classes as $class) {
            // Get basename for class
            $basename = $class->getBasename('.php');

            // Instantiate class
            $className = \sprintf('%s\\%s\\%s', __NAMESPACE__, $directory, $basename);
            $instantiated = new $className();

            // Make sure class implements the correct interface
            if (($instantiated instanceof $interface) === false) {
                // This is only here as a fail-safe if a php file which doesn't implement interface is added to
                // the directory

                continue; // @codeCoverageIgnore
            }

            $return = $closure($instantiated);

            // Keep looping until closure return something else than null
            if ($return !== null) {
                return $return;
            }
        }

        return null;
    }
}
