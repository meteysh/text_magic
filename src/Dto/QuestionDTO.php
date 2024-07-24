<?php

namespace App\Dto;

readonly class QuestionDTO
{
    public function __construct(
        private string $questionText,
        private  array $answers
    ) {
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }
}
