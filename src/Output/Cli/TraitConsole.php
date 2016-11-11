<?php

namespace Geekout\Output\Cli;

/**
 * Class TraitConsole
 *
 * @package Geekout\Output\Cli
 */
trait TraitConsole
{
    /**
     * @param $iteration
     */
    public function putsDelimiter($iteration)
    {
        for ($counter = 1; $counter < $iteration; $counter++) {
            echo '#';
        }

        $this->newLine();
    }

    /**
     * @param $howMany
     */
    public function newLine($howMany = 1)
    {
        $counter = 1;
        while ($counter++ <= $howMany) {
            echo PHP_EOL;
        }
    }
}