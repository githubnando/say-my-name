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
    private $shows = [
        'a' => 'House of Cards',
        'b' => 'Game of Thrones',
        'c' => 'Lost',
        'd' => 'Breaking Bad',
        'e' => 'Silicon Valley'
    ];

    /** @var string */
    private $answer;

    /**
     * Answer constructor.
     *
     * @param $answer
     */
    public function __construct($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getEquivalentTelevisionShow()
    {
        return $this->shows[$this->answer];
    }
}