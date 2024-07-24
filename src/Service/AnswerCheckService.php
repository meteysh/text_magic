<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\AnswerDTO;
use App\Dto\QuestionDTO;

class AnswerCheckService
{
    public function checkAnswers(array $formattedQuestions, array $selectedAnswers): array
    {
        $result = [];
        foreach ($selectedAnswers as $key => $userAnswers) {
            $correctAnswer = $this->calculateSum($formattedQuestions[$key]->getQuestionText());
            $options = [];
            foreach ($formattedQuestions[$key]->getAnswers() as $answer) {
                $options[] = $this->calculateSum($answer->getText());
            }
            $result[$key] = $this->check($correctAnswer, $options, $userAnswers);
        }

        return $this->addUnfilled($formattedQuestions, $result);
    }

    public function formatQuestion(array $questions): array
    {
        $formattedQuestions = [];
        foreach ($questions as $question) {
            $answers = [];
            foreach ($question->getAnswers() as $answer) {
                $answers[] = new AnswerDTO($answer->getText());
            }
            $formattedQuestions[$question->getId()] = new QuestionDTO($question->getText(), $answers);
        }

        return $formattedQuestions;
    }

    private function addUnfilled(array $questions, array $result): array
    {
        foreach ($questions as $key => $value) {
            if (!array_key_exists($key, $result)) {
                $result[$key] = false;
            }
        }
        return $result;
    }

    private function check(int $correctAnswer, array $options, array $userAnswers): bool
    {
        foreach ($userAnswers as $index) {
            if (!isset($options[$index]) || $options[$index] != $correctAnswer) {
                return false;
            }
        }

        foreach ($options as $index => $option) {
            if ($option != $correctAnswer && in_array($index, $userAnswers)) {
                return false;
            }
        }

        return true;
    }

    private function calculateSum(string $expression): int
    {
        $expression = str_replace(' ', '', $expression);

        if (str_contains($expression, '+') !== false) {
            $numbers = explode('+', $expression);

            if (count($numbers) === 1) {
                return (int)$numbers[0];
            }
            $sum = 0;
            foreach ($numbers as $number) {
                $sum += (int)$number;
            }
            return $sum;
        }
        return (int)$expression;
    }
}
