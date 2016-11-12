<?php

namespace Geekout\Core\Entitie\Question;

/**
 * Class AbstractQuestion
 *
 * @package Geekout\Core\Entitie\Question
 */
abstract class AbstractQuestion
{
    /** @var string Titulo de uma pergunta */
    public $title = '';

    /**
     * Alternativas da pergunta seguindo a ordem para definição da série.
     *
     * @see \Geekout\Core\Repository\Answer
     * @var array
     */
    public $originalAlternatives = [];

    /** @var array Alternativas de escolha da pergunta */
    public static $alternatives = [];

    /** @var array Chave das alternativas de escolha de uma pergunta */
    public static $questionNumerations = ['a','b','c','d','e'];

    /**
     * Por padrão, randomiza as chaves.
     *
     * AbstractQuestion constructor.
     */
    public function __construct()
    {
        $this->shuffe();
    }

    /**
     * Randomiza as alternativas, preservando a ordem original em $originalAlternatives.
     *
     * @see $originalAlternatives
     */
    private function shuffe()
    {
        $this->originalAlternatives = $this->addNumerations(static::$alternatives);
        shuffle(static::$alternatives);
        static::$alternatives = $this->addNumerations(static::$alternatives);
    }


    /**
     * Combina as chaves das alternativas com os valores.
     * ['Descricao da alternativa'] => ['a' => 'Descricao da alternativa']
     *
     * @param array $alternatives
     *
     * @return array
     */
    protected function addNumerations(array $alternatives)
    {
        return array_combine(self::$questionNumerations, static::$alternatives);
    }

    /**
     * Obtem a chave original da alternativa (seguindo a ordem original,
     * antes de randomizar as alternativas).
     *
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
     * Obtem a chave correspondente à questão de uma alternativa.
     *
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