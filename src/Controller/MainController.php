<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ResultDTO;
use App\Repository\QuestionRepository;
use App\Repository\UserAnswerRepository;
use App\Service\AnswerCheckService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function __construct(
        private readonly AnswerCheckService $answerCheckService,
        private readonly QuestionRepository $questionRepository,
        private readonly UserAnswerRepository $userAnswerRepository,
    ) {
    }

    #[Route('/questions', name: 'questions')]
    public function questions(): Response
    {
        $questions = $this->questionRepository->findAllQuestionsWithAnswers();

        return $this->render('questions/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    #[Route('/submit-answers', name: 'submit_answers', methods: ['POST'])]
    public function submit(Request $request): Response
    {
        $selectedAnswers = $request->request->all()['answers'];
        $questions = $this->questionRepository->findAllQuestionsWithAnswers();

        $formattedQuestions = $this->answerCheckService->formatQuestion($questions);
        $result = $this->answerCheckService->checkAnswers($formattedQuestions, $selectedAnswers);
        $this->userAnswerRepository->saveUserAnswer($result);

        $splitResult = $this->splitAnswers($result, $formattedQuestions);

        return $this->render('questions/result.html.twig', $splitResult);
    }

    private function splitAnswers(array $result, array $formattedQuestions): array
    {
        $trueList = [];
        $falseList = [];

        foreach ($result as $key => $value) {
            $questionText = $formattedQuestions[$key]->getQuestionText();
            $resultDTO = new ResultDTO($questionText, $value);

            if ($resultDTO->isCorrect()) {
                $trueList[] = $resultDTO->getQuestionText() . '=';
            } else {
                $falseList[] = $resultDTO->getQuestionText() . '=';
            }
        }

        return [
            'trueList' => $trueList,
            'falseList' => $falseList,
        ];
    }
}
