<?php

namespace Geekout\Core\Model;


/**
 * Class Answer
 *
 * @package Geekout\Core\Model
 */
class Answer
{
    /** @var array  */
    private $shows = [];

    /** @var array  */
    private $descriptions = [];

    /** @var array  */
    private $answers = [];


    /**
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
     * @param $answer
     *
     * @return mixed
     */
    private function getEquivalentTelevisionShow($answer)
    {
        return $this->shows[$answer];
    }

    /**
     * @return mixed
     */
    public function retrieveUserEquivalentTelevisionShow()
    {
        $result = $this->countValues($this->answers);
        arsort($result);

        if ($this->hasConcurrence($result) == true) {
            $result = $this->resolveConcurrence();
        }

        $result = array_flip($result);
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
     * @return array
     */
    private function resolveConcurrence()
    {
        $counted = [];

        foreach ($this->getAnswers() as $answer) {
            if (isset($counted[$answer]) == false) {
                $counted[$answer] = 0;
            }

            $counted[$answer] = $counted[$answer] +1;
        }

        return $counted;
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