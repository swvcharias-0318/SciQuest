<?php
    session_start();

    if (!isset($_SESSION['name']) || !isset($_SESSION['level'])) {
        header("Location: f1.php");
        exit();
    }

    $user = $_SESSION["name"];
    $level = $_SESSION["level"];
    $score = $_SESSION["score"];

    if (isset($_POST['restart'])) {
        session_unset();
        session_destroy();

        Header ("Location: f1.php");
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

    <span class="eyebrow">Mission complete</span>
    <h1>Congratulations, <?php echo htmlspecialchars($user); ?>!</h1>
    <p class="result-message">You made it through the <?php echo strtoupper($level); ?> challenge.</p>

    <div class="result-score">
        <div class="score">You scored <strong><?php echo $score; ?></strong> points</div>
    </div>

    <form method="POST" id="restartForm">
        <button type="submit" name="restart">
            Explore Again →
        </button>
    </form>

</div>

</body>
</html>
