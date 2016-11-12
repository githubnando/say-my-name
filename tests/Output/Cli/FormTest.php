<?php

use PHPUnit\Framework\TestCase;

use Geekout\Core\Entitie\Question\GointToWork;
use Geekout\Core\Entitie\Question\ArrivingAtTheBuilding;
use Geekout\Core\Entitie\Question\ArrivingAtWork;
use Geekout\Core\Entitie\Question\InTheMorning;
use Geekout\Core\Entitie\Question\ScheduleFulfilled;

/**
 * Class Form
 */
class Form extends TestCase
{
    /**
     * @dataProvider provideAnswers
     *
*@param $answers
     */
    public function testIfReturnTheLostSeriesProvidingAlwaysTheSameAnswer($answers)
    {
        /** @var \Geekout\Output\Cli\Form|\PHPUnit_Framework_MockObject_MockObject $mockedForm */
        $mockedForm = $this->getMockBuilder('\Geekout\Output\Cli\Form')->getMock();

        $questions = (new \Geekout\Core\Repository\Question())->getAllQuestions();
        $shows = (new \Geekout\Core\Repository\Answer())->getShows();

        foreach ($questions as $question) {
            $questionName = get_class($question);
            $fakedAnswer = array_search($answers[$questionName], $question::$alternatives);
            $this->invoke($mockedForm, 'receiveAnswer', [$question, $fakedAnswer]);
        }

        $model = new \Geekout\Core\Model\Answer($mockedForm->answers);

        $televisionShow = $model->retrieveUserEquivalentTelevisionShow();
        $this->assertEquals('Lost', $shows[$televisionShow]);
    }


    /**
     * @return array
     */
    public function provideAnswers()
    {
        // 'a' => 'House of Cards'
        // 'b' => 'Game of Thrones'
        // 'c' => 'Lost'
        // 'd' => 'Breaking Bad'
        // 'e' => 'Silicon Valley'

        return [[[
            GointToWork::class => GointToWork::getDescriptionBasedOnAlternativeLetter('b'),
            ScheduleFulfilled::class => ScheduleFulfilled::getDescriptionBasedOnAlternativeLetter('c'),
            ArrivingAtWork::class => ArrivingAtWork::getDescriptionBasedOnAlternativeLetter('c'),
            ArrivingAtTheBuilding::class => ArrivingAtTheBuilding::getDescriptionBasedOnAlternativeLetter('a'),
            InTheMorning::class => InTheMorning::getDescriptionBasedOnAlternativeLetter('d'),
        ]]];
    }

    /**
     * @param       $object
     * @param       $methodName
     * @param array $parameters
     *
     * @return mixed
     */
    public function invoke(&$object, $methodName, array $parameters = [])
    {
        $method = (new \ReflectionClass(get_class($object)))
            ->getMethod($methodName);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}