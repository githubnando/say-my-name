<?php

namespace Geekout\Output\Cli;

use Geekout\Core\Entitie\Question\AbstractQuestion;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Model\Answer;
use Geekout\Core\Model\Question;
use Geekout\Core\Repository\Question as QuestionRepository;

/**
 * Class Form
 *
 * @package Geekout\Output\Cli
 */
class Form
{
    use TraitConsole;

    /** @var array Respostas do usuário */
    public $answers = [];

    /**
     * Imprime o formulário de perguntas, dipondo o resultado no final.
     */
    public function display()
    {
        $answers = $this->displayQuestionsAndReceiveAnswers(new QuestionRepository);
        $model = new Answer($answers);

        $televisionShow = $model->retrieveUserEquivalentTelevisionShow();
        $resultToPrint = $model->getShowDescription($televisionShow);

        $this->displayUserTelevisionShow($resultToPrint);
    }

    /**
     * Mostra o resulado (descrição da série equivalente ao usuário).
     *
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
     * Imprime as perguntas e persiste as respostas.
     *
     * @param QuestionRepository $questionRepository
     *
     * @return array
     */
    private function displayQuestionsAndReceiveAnswers(QuestionRepository $questionRepository)
    {
        $this->answers = [];

        foreach ($questionRepository->getAllQuestions() as $question) {
            $this->putQuestion($question->title, $question::$alternatives);

            $choosenAlternative = $this->getValidResponse($this->readFromStdin());

            $this->receiveAnswer($question, $choosenAlternative);
        }

        return $this->answers;
    }

    /**
     * Persiste a resposta de uma pergunta.
     *
     * @param AbstractQuestion $question
     * @param AbstractQuestion $choosenAlternative
     */
    private function receiveAnswer(AbstractQuestion $question, $choosenAlternative)
    {
        $originalKey = $question->getAlternativeOriginalKey($choosenAlternative);
        $this->answers[] = $originalKey;
    }

    /**
     * Recursivamente pergunta ao usuário uma resposta válida (de acordo com
     * as opções de uma pergunta).
     *
     * @param $response
     * @see AbstractQuestion::$questionNumerations
     *
     * @return string
     */
    public function getValidResponse($response)
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
     * Obtem a pergunta.
     *
     * @return string
     */
    public function readFromStdin()
    {
        $handler = fopen('php://stdin', 'r');
        $response = fgetc($handler);
        fclose($handler);
        return strtolower($response);
    }
}