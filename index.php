<?php

require_once(__DIR__ . '/config.php');

$quiz = new MyApp\Quiz();

if (!$quiz->isFinished()) {
    $data = $quiz->getCurrentQuiz();
    shuffle($data['a']);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css">
    <title>クイズ</title>
</head>
<body>
    <?php if ($quiz->isFinished()) : ?>
        <div id="container">
            <div id="result">
                Your score ...
                <div><?= h($quiz->getScore()) ?> %</div>
            </div>
            <a href="./quiz"><div id="btn">Replay?</div></a>
        </div>
        <?php $quiz->reset(); ?>
    <?php else : ?>
        <div id="container">
            <h1>Q. <?= h($data['q']); ?></h1>
            <ul>
            <?php foreach( $data['a'] as $ans) : ?>
            <li class="answer"><?= h($ans); ?></li>
            <?php endforeach; ?>
            </ul>
            <div id="btn" class="disabled"><?= $quiz->isLast() ? 'Show Result' : 'Next Question' ?></div>
            <input type="hidden" id="token" value="<?= h($_SESSION['token']); ?>">
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="./quiz.js"></script>
    <?php endif ; ?>
</body>
</html>
