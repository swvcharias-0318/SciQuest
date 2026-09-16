<?php
session_start();

if (isset($_POST['start'])) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['level'] = $_POST['level'];
    $_SESSION['question_number'] = 0;
    $_SESSION['score'] = 0;
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

    <span class="eyebrow">The science quest</span>
    <h1>Welcome to SciQuest</h1>
    <p class="intro"></p>

    <form method="POST">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="level">Choose your challenge</label>
        <select name="level" id="level" required>
            <option value="level1">Level 1 · Explorer</option>
            <option value="level2">Level 2 · Thinker</option>
            <option value="level3">Level 3 · Trailblazer</option>
        </select>

        <button type="submit" name="start">Start Quiz</button>
    </form>
</div>
</body>
</html>
