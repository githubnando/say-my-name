<?php

namespace Geekout\Output\Cli;

use Geekout\Core\Entitie\Question\AbstractQuestion;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Model\Answer;
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

        $answers = [];
        foreach ($questionRepository->getAllQuestions() as $questionObject) {
            $this->putQuestion($questionObject->title, $questionObject->alternatives);
            $answers[] = $this->getValidResponse($this->readFromStdin());
        }

        $model = new Answer($answers);

        $televisionShow = $model->retrieveUserEquivalentTelevisionShow();
        $resultToPrint = $model->getShowDescription($televisionShow);

        $this->displayUserTelevisionShow($resultToPrint);
    }

    /**
     * @param $description
     */
    private function displayUserTelevisionShow($description)
    {
        $this->newLine(2);

        $howMany = (strlen(Header::$title) + 11);
        $this->putDelimiter($howMany);

        $this->newLine();

        echo $this->indent(1, $description);

        $this->newLine(2);
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