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
    private $shows;

    /** @var array  */
    private $descriptions = [];

    private $answers = [];

    /**
     * Answer constructor.
     *
     * @param answers
     */
    public function __construct($answers)
    {
        $this->answers = $answers;

        $this->setDescriptions([
            'a' => 'Você é House of Cards: ataca o problema com método e faz de ' .
                'tudo para resolver a situação.',

            'b'=> 'Você é Game of Thrones: não tem muita delicadeza nas ações, ' .
                'mas resolve o problema de forma prática.',

            'c' => 'Você é Lost: faz as coisas sem ter total certeza se é o caminho certo ou se faz ' .
                'sentido, mas no final dá tudo certo.',

            'd' => 'Você é Breaking Bad: pra fazer acontecer você toma a liderança, mas ' .
                'sempre contando com seus parceiros.',

            'e' => 'Você é Silicon Valley: vive a tecnologia o tempo todo e faz disso um ' .
                'mantra para cada situação no dia.',
        ]);

        $this->setShows([
            'a' => 'House of Cards',
            'b' => 'Game of Thrones',
            'c' => 'Lost',
            'd' => 'Breaking Bad',
            'e' => 'Silicon Valley'
        ]);
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
        $counted = [];

        foreach ($this->getAnswers() as $answer) {
            if (isset($counted[$answer]) == false) {
                $counted[$answer] = 0;
            }

            $counted[$answer] = $counted[$answer] +1;
        }

        asort($counted);
        $counted = array_flip($counted);
        $showIdentifier = (string) end($counted);
        return $showIdentifier;
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