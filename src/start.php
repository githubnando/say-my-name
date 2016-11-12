<?php

require __DIR__ . '/../vendor/autoload.php';

use Geekout\Core\Model\Question;
use Geekout\Core\Model\Answer;

(new \Geekout\Output\Cli\Header())->display();
(new \Geekout\Output\Cli\Form())->display();