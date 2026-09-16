<?php
session_start();

$questions = [
    "level1" => [
        ["question" => "Question1?", "answer" => 15],
        ["question" => "Question2?", "answer" => 7],
        ["question" => "Question1?", "answer" => 12]
    ],

    "level2" => [
        ["question" => "Question1?", "answer" => 30],
        ["question" => "Question2?", "answer" => 32],
        ["question" => "Question3?", "answer" => 16],
        ["question" => "Question4?", "answer" => 6],
        ["question" => "Question5?", "answer" => 21]
    ],

    "level3" => [
        ["question" => "Question1?", "answer" => 16],
        ["question" => "Question2?", "answer" => 32],
        ["question" => "Question3?", "answer" => 95],
        ["question" => "Question4?", "answer" => 36],
        ["question" => "Question5?", "answer" => 24],
        ["question" => "Question6?", "answer" => 10],
        ["question" => "Question7?", "answer" => 35]
    ]
];

    if (!isset($_SESSION['name']) || !isset($_SESSION['level'])) {
        header("Location: f1.php");
        exit();
    }

    $level = $_SESSION['level'];
    $question_number = $_SESSION['question_number'];


    $selected_questions = $questions[$level];
    $total_questions = count($selected_questions);
    $current_question = $selected_questions[$question_number];
   

if (isset($_POST['submit_answer']) && $_SESSION['answered'] == false) {

    $user_answer = $_POST['answer'];
    $correct_answer = $current_question['answer'];

    if ($user_answer == $correct_answer) {

        $_SESSION['correct'] = true;

        if ($level == "level1") {
            $_SESSION['score'] = $_SESSION['score'] + 1;
        }
        else if ($level == "level2") {
            $_SESSION['score'] = $_SESSION['score'] + 2;
        }
        else if ($level == "level3") {
            $_SESSION['score'] = $_SESSION['score'] + 3;
        }

    } else {
        $_SESSION['correct'] = false;
    }

    $_SESSION['answered'] = true;

    header("Location: f2.php");
    exit();
}


if (isset($_POST['next'])) {

    $_SESSION['question_number']++;

    if ($_SESSION['question_number'] >= $total_questions) {
        header("Location: f3.php");
        exit();
    }

    $_SESSION['answered'] = false;
    $_SESSION['correct'] = false;

    header("Location: f2.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css">
    <title>SciQuest</title>
</head>
<body>
<div class="container">

    <div class="quiz-header">
        <span class="level"><?php echo strtoupper($level); ?></span>
        <span class="player">Player: <?php echo htmlspecialchars($_SESSION['name']); ?></span>
        <p class="question-number">Question <?php echo $question_number + 1; ?> out of <?php echo $total_questions; ?></p>
        <div class="progress-track" aria-label="Quiz progress">
            <div class="progress-bar" style="width: <?php echo (($question_number + 1) / $total_questions) * 100; ?>%;"></div>
        </div>
    </div>

    <div class="question">
        <?php echo $current_question['question']; ?>
    </div>

    <?php if ($_SESSION['answered'] == false): ?>

        <form method="POST">
            <input type="text"
                   name="answer"
                   placeholder="Enter your answer"
                   required
                   autofocus>

            <button type="submit" name="submit_answer">
                Submit Answer
            </button>
        </form>

    <?php else: ?>

        <?php if ($_SESSION['correct'] == true): ?>

            <div class="correct">
                Koreeeekkkk. Very good!
            </div>

        <?php else: ?>

            <div class="incorrect">
                Enkk your wrong. The correct answer is
                <?php echo $current_question['answer']; ?>
            </div>

        <?php endif; ?>

        <form method="POST">
            <button type="submit" name="next">
                <?php
                if ($question_number + 1 >= $total_questions) {
                    echo "See My Results →";
                } else {
                    echo "Next Question →";
                }
                ?>
            </button>
        </form>

    <?php endif; ?>

    <div class="score">
        Score:
        <strong><?php echo $_SESSION['score']; ?></strong>
    </div>

</div>
</body>
</html>
