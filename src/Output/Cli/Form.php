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

    private $answers;

    public function display()
    {
        $questionRepository = new \Geekout\Core\Repository\Question();

        foreach ($questionRepository->getAllQuestions() as $question) {
            $this->displayQuestionAndReadFromStdin($question);
        }
    }

    /**
     * @param AbstractQuestion $questionObject
     */
    private function displayQuestionAndReadFromStdin(AbstractQuestion $questionObject)
    {
        $this->putQuestion($questionObject->title, $questionObject->alternatives);

        $this->answers[] = $this->getValidResponse($this->readFromStdin());
    }

    /**
     * @param      $response
     *
     * @return string
     */
    private function getValidResponse($response)
    {
        if (in_array($response, AbstractQuestion::$questionNumerations)) {
            return $response;
        }

        $range = strtoupper(AbstractQuestion::$questionNumerations[0]);
        $range .= ' à ';
        $range .= strtoupper(end(AbstractQuestion::$questionNumerations));

        $this->newLine();
        $this->indent(2, 'Você precisa informar uma letra de ' . $range. ': ');

        return $this->getValidResponse($this->readFromStdin());
    }

    /**
     * @return string
     */
    private function readFromStdin()
    {
        $handler = fopen('php://stdin', 'r');
        $response = fgetc($handler);
        fclose($handler);
        return $response;
    }
}