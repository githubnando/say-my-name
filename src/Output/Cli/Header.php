<?php

namespace Geekout\Output\Cli;

/**
 * Class Header
 */
class Header
{
    private $delimiter = '#';

    private $title = 'Hello darkness my old friend, i\'ve come to talk to you again! :)';

    public function display()
    {
        $this->newLine();

        $howMany = (strlen($this->title) + 11);
        $this->putsDelimiter($howMany);

        echo "#### {$this->title} ####";
        $this->newLine();

        $this->putsDelimiter($howMany);
    }

    /**
     * @param $iteration
     */
    private function putsDelimiter($iteration)
    {
        for ($counter = 1; $counter < $iteration; $counter++) {
            echo '#';
        }

        $this->newLine();
    }

    /**
     * @param $howMany
     */
    private function newLine($howMany = 1)
    {
        $counter = 1;
        while ($counter++ <= $howMany) {
            echo PHP_EOL;
        }
    }
}