<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class AbstractQuestion
 *
 * @package Geekout\Core\Entitie\Question
 */
abstract class AbstractQuestion
{
    public $title = '';

    public $alternatives = [];

    public $originalAlternatives = [];

    public static $questionNumerations = ['a','b','c','d','e'];

    /**
     * AbstractQuestion constructor.
     */
    public function __construct()
    {
        $this->shuffe();
    }

    private function shuffe()
    {
        $this->originalAlternatives = $this->addNumerations($this->alternatives);
        shuffle($this->alternatives);
        $this->alternatives = $this->addNumerations($this->alternatives);
    }


    /**
     * @param array $alternatives
     *
     * @return array
     */
    protected function addNumerations(array $alternatives)
    {
        return array_combine(self::$questionNumerations, $this->alternatives);
    }

    /**
     * @param $choosenAlternative
     *
     * @return mixed
     */
    public function getAlternativeOriginalKey($choosenAlternative)
    {
        $questionResponseToDisplay = $this->alternatives[$choosenAlternative];
        return array_search($questionResponseToDisplay, $this->originalAlternatives);
    }
}