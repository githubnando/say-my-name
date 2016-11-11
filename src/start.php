<?php

require __DIR__ . '/../vendor/autoload.php';

use Geekout\Core\Model\Question;
use Geekout\Core\Model\Answer;

use Geekout\Core\Entitie\Question\GointToWork;

$question = new Question(new GointToWork);
(new \Geekout\Output\Cli\Header())->display();
(new \Geekout\Output\Cli\Form())->display();

# print_r($question->getAnswer('e')->getEquivalentTelevisionShow());



