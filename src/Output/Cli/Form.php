<?php

namespace Geekout\Output\Cli;

use Geekout\Core\Entitie\Question\AbstractQuestion;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Model\Question;

/**
 * Class Form
 *
 * @package Geekout\Output\Cli
 */
class Form
{
    use TraitConsole;

    public function display()
    {
        $questionRepository = new \Geekout\Core\Repository\Question();

        array_walk($questionRepository->getAllQuestions(), [$this, 'displayQuestionAndReadFromStdin']);
    }

    /**
     * @param AbstractQuestion $questionObject
     */
    private function displayQuestionAndReadFromStdin(AbstractQuestion $questionObject)
    {
        $this->putQuestion($questionObject->title, $questionObject->alternatives);

        $responses[] = fgetc(STDIN);
        $this->newLine();
    }
}