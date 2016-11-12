<?php

namespace Geekout\Core\Model;


/**
 * Responsável pelas operações relacionadas às respostas.
 *
 * Class Answer
 *
 * @package Geekout\Core\Model
 */
class Answer
{
    /** @var array Séries de televisão disponíveis */
    private $shows = [];

    /** @var array Descrição das séries de televisão (resposta) */
    private $descriptions = [];

    /** @var array Array com as respostas do usuário */
    private $answers = [];

    /**
     *
     * Answer constructor.
     *
     * @param answers
     */
    public function __construct($answers)
    {
        $this->answers = $answers;

        $descriptions = (new \Geekout\Core\Repository\Question())->getDescriptions();
        $shows = (new \Geekout\Core\Repository\Answer())->getShows();

        $this->setDescriptions($descriptions);
        $this->setShows($shows);
    }

    /**
     * Obtem a série de televisão equivalente de acordo com as respostas fornecidas pelo usuário.
     * Conta o maior número de respostas equivalente a uma série, se houver empate, retorna
     * de acordo com um mapa, para gerar respostas únicas em todas as combinações.
     *
     * @return mixed
     */
    public function retrieveUserEquivalentTelevisionShow()
    {
        $countedAnswers = $this->countValues($this->answers);
        arsort($countedAnswers);

        if ($this->hasConcurrence($countedAnswers) == true) {
            $countedAnswers = $this->resolveConcurrence($countedAnswers);
        }

        $result = array_flip($countedAnswers);
        return (string) current($result);
    }

    /**
     * @param $counted
     *
     * @return bool
     */
    private function hasConcurrence($counted)
    {
        $first = current($counted);
        $second = next($counted);

        if ($second && $first == $second) {
            return true;
        }

        return false;
    }

    /**
     * Conta o número de respostas equivalente a uma série das respostas do
     * usuario.
     *
     * @param $objects
     *
     * @return array
     */
    private function countValues($objects)
    {
        $result = [];

        foreach ($objects as $object) {
            if (isset($result[$object]) == false) {
                $result[$object] = 0;
            }

            $result[$object] = ++$result[$object];
        }

        return $result;
    }

    /**
     * Resolve o empate utilizando mapa de tradução com base na resposta que não está
     * em concorrência (empate).
     *
     * @param array $countedAnswers Array com as respostas do usuário contadas
     *
     * @return array
     */
    private function resolveConcurrence($countedAnswers)
    {
        $checksum = [
            'a' => 'e',
            'b' => 'd',
            'c' => 'c',
            'd' => 'b',
            'e' => 'a',
        ];

        $alternativeThatWasChoiceOnlyOneTime = end(array_keys($countedAnswers));
        $countedAnswers[$alternativeThatWasChoiceOnlyOneTime] = 99;

        arsort($countedAnswers);
        return $countedAnswers;
    }

    /**
     * @param $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @param array $shows
     *
     * @return array
     */
    public function setShows(array $shows)
    {
        return $this->shows = $shows;
    }

    /**
     * @return array
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param $answer
     *
     * @return mixed
     */
    public function getShowDescription($answer)
    {
        return $this->descriptions[$answer];
    }

    /**
     * @return array
     */
    public function getShows()
    {
        return $this->shows;
    }

    /**
     * @param $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return mixed
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}