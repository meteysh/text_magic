<?php

namespace App\Dto;

readonly class ResultDTO
{
    public function __construct(
        private string $questionText,
        private bool $isCorrect,
    ) {
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}

