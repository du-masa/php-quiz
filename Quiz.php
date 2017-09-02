<?php

namespace MyApp;

class Quiz {
    private $_quizSet = [];
    public function __construct() {

        $this->_setUp();
        Token::create();

        if (!isset($_SESSION['current_num'])) {
            $this->initSession();
        }
    }

    private function initSession() {
        $_SESSION['current_num'] = 0;
        $_SESSION['current_count'] = 0;
    }

    private function _setUp() {
        $this->_quizSet[] = [
            'q' => 'What is A?',
            'a' => ['A0', 'A1', 'A2', 'A3'],
        ];
        $this->_quizSet[] = [
            'q' => 'What is B?',
            'a' => ['B0', 'B1', 'B2', 'B3'],
        ];
        $this->_quizSet[] = [
            'q' => 'What is C?',
            'a' => ['C0', 'C1', 'C2', 'C3'],
        ];
    }

    public function checkAnswer() {
        Token:: validate('token');
        $correctAnswer = $this->_quizSet[$_SESSION['current_num']]['a'][0];
        if (!isset($_POST['answer'])) {
            throw new \Exception('answer not set!');
        }
        if ($correctAnswer === $_POST['answer']) {
            $_SESSION['currect_count']++;
        }
        $_SESSION['current_num']++;
        return $correctAnswer;
    }

    public function isFinished() {
        return count($this->_quizSet) === $_SESSION['current_num'];
    }

    public function isLast() {
        return count($this->_quizSet) === ($_SESSION['current_num'] + 1);
    }

    public function getScore() {
        return round($_SESSION['currect_count'] / count($this->_quizSet) * 100);
    }

    public function reset() {
        $this->initSession();
    }

    public function getCurrentQuiz() {
        return $this->_quizSet[$_SESSION['current_num']];
    }
}
