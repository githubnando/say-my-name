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

    public $originalAlternatives = [];

    public static $alternatives = [];

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
        $this->originalAlternatives = $this->addNumerations(static::$alternatives);
        shuffle(static::$alternatives);
        static::$alternatives = $this->addNumerations(static::$alternatives);
    }


    /**
     * @param array $alternatives
     *
     * @return array
     */
    protected function addNumerations(array $alternatives)
    {
        return array_combine(self::$questionNumerations, static::$alternatives);
    }

    /**
     * @param $choosenAlternative
     *
     * @return mixed
     */
    public function getAlternativeOriginalKey($choosenAlternative)
    {
        $questionResponseToDisplay = static::$alternatives[$choosenAlternative];
        return array_search($questionResponseToDisplay, $this->originalAlternatives);
    }

    /**
     * @param $letter
     *
     * @return mixed
     */
    public static function getDescriptionBasedOnAlternativeLetter($letter)
    {
        $index = 0;
        $map = [];

        foreach (self::$questionNumerations as $numeration) {
            if ($letter == $numeration) {
                break;
            }

            $index++;
        }

        return static::$alternatives[$index];
    }
}