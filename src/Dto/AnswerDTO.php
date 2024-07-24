<?php

namespace App\Dto;

readonly class AnswerDTO
{
    public function __construct(
        private string $text
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }
}

