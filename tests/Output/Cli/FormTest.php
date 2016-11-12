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
            $fakedAnswer = array_search($answers[$questionName], $question->alternatives);
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
        return [[[
            GointToWork::class => 'Levanta a senhora e jura protegê­la com sua vida',
            ScheduleFulfilled::class => 'No ponto de ônibus mais uma vez, espero não errar a linha de novo',
            ArrivingAtWork::class => 'Puxa um assunto e te lembram que já foi discutido semana passada',
            ArrivingAtTheBuilding::class => 'Convence parte das pessoas a esperarem o próximo',
            InTheMorning::class => 'Levanta e faz café pra todos da casa',
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